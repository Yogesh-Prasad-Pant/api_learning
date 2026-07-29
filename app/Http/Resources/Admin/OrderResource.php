<?php

namespace App\Http\Resources\Admin;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{

    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'shop_id'         => $this->shop_id,
            'user_id'         => $this->user_id,
            'status'          => $this->status,
            'payment_status' => $this->payment_status,
            'tracking_number' => $this->tracking_number,
            'admin_note'      => $this->admin_note,
            'total_amount'    => (float) $this->total_amount,
            
            // Timestamps formatted safely
            'delivered_at'    => $this->delivered_at?->toIso8601String(),
            'cancelled_at'    => $this->cancelled_at?->toIso8601String(),
            'created_at'      => $this->created_at?->toIso8601String(),
            'updated_at'      => $this->updated_at?->toIso8601String(),

            // Conditional Relationships (Only included when loaded via `with()`)
            'user' => $this->whenLoaded('user', function () {
                return [
                    'id'    => $this->user->id,
                    'name'  => $this->user->name,
                    'email' => $this->user->email,
                    'phone' => $this->user->phone ?? null,
                ];
            }),

            'shop' => $this->whenLoaded('shop', function () {
                return [
                    'id'        => $this->shop->id,
                    'shop_name' => $this->shop->shop_name,
                ];
            }),

            'order_items' => $this->whenLoaded('orderItems'),
        ];
    }
}