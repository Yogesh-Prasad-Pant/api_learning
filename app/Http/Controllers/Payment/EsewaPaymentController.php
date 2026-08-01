<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Payment;
use App\Services\EsewaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class EsewaPaymentController extends Controller
{
    protected EsewaService $esewaService;

    public function __construct(EsewaService $esewaService)
    {
        $this->esewaService = $esewaService;
    }

    /**
     * Initiate eSewa Payment for an unpaid order.
     * POST /api/payments/esewa/initiate
     */
    public function initiate(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
        ]);

        // Lock to the authenticated customer for security
        $order = Order::where('user_id', $request->user()->id)
            ->where('id', $request->order_id)
            ->firstOrFail();

        if (strtoupper($order->payment_status) === 'PAID') {
            return response()->json([
                'success' => false,
                'message' => 'This order is already paid.',
            ], 400);
        }

        // Generate a unique transaction UUID (Order ID + Timestamp)
        $transactionUuid = 'ORD-' . $order->id . '-' . time();

        // Get payload & signature from EsewaService
        $payload = $this->esewaService->getPaymentPayload($order, $transactionUuid);

        return response()->json([
            'success' => true,
            'message' => 'eSewa payment initiated successfully.',
            'payload' => $payload,
        ]);
    }

    /**
     * Handle eSewa Redirect Callback on Payment Success.
     * GET /api/payments/esewa/success
     */
    public function success(Request $request)
    {
        $encodedData = $request->query('data');

        if (!$encodedData) {
            return response()->json(['success' => false, 'message' => 'Invalid response payload from eSewa.'], 400);
        }

        $decodedData = json_decode(base64_decode($encodedData), true);

        if (!$decodedData) {
            return response()->json(['success' => false, 'message' => 'Failed to decode eSewa response.'], 400);
        }

        $status          = $decodedData['status'] ?? null;
        $totalAmount     = $decodedData['total_amount'] ?? null;
        $transactionUuid = $decodedData['transaction_uuid'] ?? null;
        $productCode     = $decodedData['product_code'] ?? null;
        $refId           = $decodedData['transaction_code'] ?? null;

        if ($status !== 'COMPLETE') {
            return response()->json(['success' => false, 'message' => 'Payment was not completed.'], 400);
        }

        // Verify transaction directly with eSewa API
        $isVerified = $this->esewaService->verifyTransaction($productCode, $totalAmount, $transactionUuid);

        if (!$isVerified) {
            return response()->json(['success' => false, 'message' => 'eSewa payment verification failed.'], 422);
        }

        // Extract internal Order ID from ORD-{id}-{timestamp}
        $parts = explode('-', $transactionUuid);
        $orderId = $parts[1] ?? null;

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Order not found.'], 404);
        }

        // If already paid, avoid duplicate creation (Idempotency)
        if (strtoupper($order->payment_status) === 'PAID') {
            return response()->json([
                'success' => true,
                'message' => 'Payment already recorded.',
                'order_id' => $order->id,
            ]);
        }

        DB::transaction(function () use ($order, $refId, $decodedData) {
            // Update Order Status & Payment Status
            $order->update([
                'payment_status' => 'PAID',
                'status'         => 'processing', // Move order from pending to processing
            ]);

            // Log Payment Record if table exists
            if (Schema::hasTable('payments')) {
                Payment::firstOrCreate(
                    ['transaction_code' => $refId],
                    [
                        'order_id'       => $order->id,
                        'payment_method' => 'ESEWA',
                        'amount'         => $order->total_amount,
                        'status'         => 'COMPLETED',
                        'raw_response'   => json_encode($decodedData),
                    ]
                );
            }
        });

        return response()->json([
            'success'  => true,
            'message'  => 'Payment successful! Order status updated to PAID.',
            'order_id' => $order->id,
        ]);
    }

    /**
     * Handle eSewa Redirect Callback on Payment Failure/Cancellation.
     * GET /api/payments/esewa/failure
     */
    public function failure(Request $request)
    {
        Log::warning('eSewa Payment Failed or Cancelled by User', $request->all());

        return response()->json([
            'success' => false,
            'message' => 'Payment failed or was cancelled by user.',
        ], 400);
    }
}