<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Order Confirmation #' . $this->order->order_number)
            ->greeting('Hello ' . ($this->order->customer_name ?? $notifiable->name) . '!')
            ->line('Thank you for your order. We have successfully received it!')
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Total Amount: Rs. ' . number_format($this->order->total_price, 2))
            ->line('Payment Status: ' . strtoupper($this->order->payment_status))
            ->action('View Order', url('/customer/dashboard/orders-details/' . $this->order->order_number))
            ->line('We will notify you once your order is shipped.');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'total_price'  => $this->order->total_price,
            'status'       => $this->order->status,
            'message'      => 'Your order #' . $this->order->order_number . ' was placed successfully.',
        ];
    }
}