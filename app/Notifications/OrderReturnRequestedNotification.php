<?php

namespace App\Notifications;

use App\Models\OrderReturn;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReturnRequestedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public OrderReturn $orderReturn;

    /**
     * Create a new notification instance.
     */
    public function __construct(OrderReturn $orderReturn)
    {
        $this->orderReturn = $orderReturn;
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Return Request Submitted - Order #' . $this->orderReturn->order_id)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('A return request has been submitted for Order #' . $this->orderReturn->order_id . '.')
            ->line('Reason: ' . $this->orderReturn->reason)
            ->line('Refund Amount Requested: $' . number_format($this->orderReturn->refund_amount, 2))
            ->action('Review Return Request', url('/vendor/returns/' . $this->orderReturn->id))
            ->line('Please review this request within your policy timeframe.');
    }

    /**
     * Get the array representation of the notification for database storage.
     */
    public function toArray(object $notifiable): array
    {
        return [
            'return_id'     => $this->orderReturn->id,
            'order_id'      => $this->orderReturn->order_id,
            'reason'        => $this->orderReturn->reason,
            'refund_amount' => $this->orderReturn->refund_amount,
            'message'       => 'Return requested for Order #' . $this->orderReturn->order_id . '.',
            'type'          => 'order_return_requested',
        ];
    }
}