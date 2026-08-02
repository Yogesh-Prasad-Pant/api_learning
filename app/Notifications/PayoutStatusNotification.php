<?php

namespace App\Notifications;

use App\Models\PayoutRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PayoutStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public PayoutRequest $payoutRequest) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $status = ucfirst($this->payoutRequest->status);
        $shopName = $this->payoutRequest->shop?->name ?? 'Your Shop';

        return (new MailMessage)
            ->subject("[$shopName] Payout Request {$status}")
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line("Your payout request for Rs. " . number_format($this->payoutRequest->amount, 2) . " has been {$this->payoutRequest->status}.")
            ->line('Transaction / Reference Note: ' . ($this->payoutRequest->admin_note ?? 'N/A'))
            ->action('View Payouts', url('/admin/shop/payout-requests'));
    }

    public function toArray(object $notifiable): array
    {
        $shopName = $this->payoutRequest->shop?->name ?? 'Your Shop';
        return [
            'payout_id' => $this->payoutRequest->id,
            'shop_id'   => $this->payoutRequest->shop_id,
            'shop_name' => $shopName,
            'amount'    => $this->payoutRequest->amount,
            'status'    => $this->payoutRequest->status,
            'message'   => 'Your payout request of Rs. ' . $this->payoutRequest->amount . ' is now ' . $this->payoutRequest->status . '.',
        ];
    }
}