<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNewOrderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(public Order $order) {}

    public function via(object $notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $shopName = $this->order->shop?->name ?? 'Your Shop';
        return (new MailMessage)
            ->subject("[$shopName] New Order Received - #" . $this->order->order_number)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line("You have received a new order for **{$shopName}**.")
            ->line('Order Number: ' . $this->order->order_number)
            ->line('Vendor Earning: Rs. ' . number_format($this->order->vendor_earning, 2))
            ->line('Customer Name: ' . $this->order->customer_name)
            ->action('View Order in Admin Panel', url('/admin/shop/orders/' . $this->order->id))
            ->line('Please process and ship this order as soon as possible.');
    }

    public function toArray(object $notifiable): array
    {
        $shopName = $this->order->shop?->name ?? 'Your Shop';

        return [
            'order_id'       => $this->order->id,
            'order_number'   => $this->order->order_number,
            'shop_id'        => $this->order->shop_id,
            'shop_name'      => $shopName,
            'vendor_earning' => $this->order->vendor_earning,
            'message'        => 'New order #' . $this->order->order_number . ' received.',
        ];
    }
}