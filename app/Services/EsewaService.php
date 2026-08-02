<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EsewaService
{
    protected string $merchantCode;
    protected string $secretKey;
    protected string $baseUrl;
    protected string $successUrl;
    protected string $failureUrl;

    public function __construct()
    {
        $this->merchantCode = config('services.esewa.merchant_code');
        $this->secretKey    = config('services.esewa.secret_key');
        $this->baseUrl      = config('services.esewa.base_url');
        $this->successUrl   = config('services.esewa.success_url');
        $this->failureUrl   = config('services.esewa.failure_url');
    }

    
    public function generateSignature(string $totalAmount, string $transactionUuid): string
    {
        $dataToSign = "total_amount={$totalAmount},transaction_uuid={$transactionUuid},product_code={$this->merchantCode}";

        $rawHmac = hash_hmac('sha256', $dataToSign, $this->secretKey, true);

        return base64_encode($rawHmac);
    }

    public function verifyResponseSignature(array $decodedData): bool
    {
        if (empty($decodedData['signature']) || empty($decodedData['signed_field_names'])) {
            return false;
        }

        $signedFieldNames = explode(',', $decodedData['signed_field_names']);
        $dataToSignArr = [];

        foreach ($signedFieldNames as $field) {
            $value = $decodedData[$field] ?? '';
            $dataToSignArr[] = "{$field}={$value}";
        }

        $dataToSign = implode(',', $dataToSignArr);
        $computedSignature = base64_encode(hash_hmac('sha256', $dataToSign, $this->secretKey, true));

        return hash_equals($computedSignature, $decodedData['signature']);
    }

    /**
     * Prepare the payment form payload for eSewa ePay v2 redirection.
     */
    public function getPaymentPayload($order, string $transactionUuid): array
    {
        $totalAmount = number_format($order->total_price, 2, '.', '');

        $signature = $this->generateSignature($totalAmount, $transactionUuid);

        return [
            'amount'                 => $totalAmount,
            'tax_amount'             => '0.00',
            'total_amount'           => $totalAmount,
            'transaction_uuid'       => $transactionUuid,
            'product_code'           => $this->merchantCode,
            'product_service_charge' => '0.00',
            'product_delivery_charge'=> '0.00',
            'success_url'            => $this->successUrl,
            'failure_url'            => $this->failureUrl,
            'signed_field_names'     => 'total_amount,transaction_uuid,product_code',
            'signature'              => $signature,
            'payment_url'            => $this->baseUrl . '/api/epay/main/v2/form',
        ];
    }

    /**
     * Verify payment transaction status directly with eSewa Status API.
     */
    public function verifyTransaction(string $productCode, string $totalAmount, string $transactionUuid): bool
    {
        try {
            $formattedAmount = number_format((float) $totalAmount, 2, '.', '');
            $endpoint = $this->baseUrl . '/api/epay/transaction/status/';

            $response = Http::get($endpoint, [
                'product_code'     => $productCode,
                'total_amount'     => $formattedAmount,
                'transaction_uuid' => $transactionUuid,
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // eSewa returns 'COMPLETE' on successful payment
                return isset($data['status']) && strtoupper($data['status']) === 'COMPLETE';
            }

            Log::error('eSewa Verification API failed response', ['response' => $response->body()]);
            return false;
        } catch (\Exception $e) {
            Log::error('eSewa Verification Exception: ' . $e->getMessage());
            return false;
        }
    }
}