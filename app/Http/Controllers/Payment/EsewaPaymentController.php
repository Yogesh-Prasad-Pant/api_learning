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

        $order = Order::findOrFail($request->order_id);

        if (strtoupper($order->payment_status) === 'PAID') {
            return response()->json([
                'message' => 'This order is already paid.',
            ], 400);
        }

        // Generate a unique transaction UUID (Order ID + Timestamp)
        $transactionUuid = 'ORD-' . $order->id . '-' . time();

        // Get payload & signature from EsewaService
        $payload = $this->esewaService->getPaymentPayload($order, $transactionUuid);

        return response()->json([
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
            return response()->json(['message' => 'Invalid response payload from eSewa.'], 400);
        }

        $decodedData = json_decode(base64_decode($encodedData), true);

        if (!$decodedData) {
            return response()->json(['message' => 'Failed to decode eSewa response.'], 400);
        }

        $status          = $decodedData['status'] ?? null;
        $totalAmount     = $decodedData['total_amount'] ?? null;
        $transactionUuid = $decodedData['transaction_uuid'] ?? null;
        $productCode     = $decodedData['product_code'] ?? null;
        $refId           = $decodedData['transaction_code'] ?? null;

        if ($status !== 'COMPLETE') {
            return response()->json(['message' => 'Payment was not completed.'], 400);
        }

        // Verify transaction directly with eSewa API
        $isVerified = $this->esewaService->verifyTransaction($productCode, $totalAmount, $transactionUuid);

        if (!$isVerified) {
            return response()->json(['message' => 'eSewa payment verification failed.'], 422);
        }

        // Extract internal Order ID from ORD-{id}-{timestamp}
        $parts = explode('-', $transactionUuid);
        $orderId = $parts[1] ?? null;

        $order = Order::find($orderId);

        if (!$order) {
            return response()->json(['message' => 'Order not found.'], 404);
        }

        DB::transaction(function () use ($order, $refId, $decodedData) {
            // Update Order Payment Status
            $order->update(['payment_status' => 'PAID']);

            // Log Payment Record if table exists
            if (Schema::hasTable('payments')) {
                Payment::create([
                    'order_id'         => $order->id,
                    'payment_method'   => 'ESEWA',
                    'transaction_code' => $refId,
                    'amount'           => $order->total_amount,
                    'status'           => 'COMPLETED',
                    'raw_response'     => json_encode($decodedData),
                ]);
            }
        });

        return response()->json([
            'message' => 'Payment successful! Order status updated to PAID.',
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
            'message' => 'Payment failed or was cancelled by user.',
        ], 400);
    }
}