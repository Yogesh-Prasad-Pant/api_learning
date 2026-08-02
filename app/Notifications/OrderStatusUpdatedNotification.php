<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderStatusUpdatedNotification extends Notification implements ShouldQueue
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
            ->subject('Order Status Update - #' . $this->order->order_number)
            ->greeting('Hello ' . ($this->order->customer_name ?? $notifiable->name) . '!')
            ->line('The status of your order #' . $this->order->order_number . ' has been updated.')
            ->line('New Status: ' . strtoupper($this->order->status))
            ->action('Track Order', url('/customer/dashboard/orders-details/' . $this->order->order_number))
            ->line('Thank you for shopping with us!');
    }

    public function toArray(object $notifiable): array
    {
        return [
            'order_id'     => $this->order->id,
            'order_number' => $this->order->order_number,
            'status'       => $this->order->status,
            'message'      => 'Order #' . $this->order->order_number . ' status changed to ' . $this->order->status . '.',
        ];
    }
}