<?php

namespace App\Policies;

use App\Models\Admin;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Perform pre-authorization checks.
     * If the admin is a superadmin, grant all permissions automatically.
     */
    public function before(Admin $admin, string $ability): ?bool
    {
        if ($admin->is_superadmin) {
            return true;
        }

        return null; // Fall through to specific policy methods
    }

    /**
     * Determine whether the admin can view any orders.
     */
    public function viewAny(Admin $admin): bool
    {
        // Any active admin can view the index list (filtered by shop scope in query)
        return true;
    }

    /**
     * Determine whether the admin can view the specific order.
     */
    public function view(Admin $admin, Order $order): bool
    {
        return $this->belongsToAdminShop($admin, $order);
    }

    /**
     * Determine whether the admin can update the specific order.
     */
    public function update(Admin $admin, Order $order): bool
    {
        return $this->belongsToAdminShop($admin, $order);
    }

    /**
     * Determine whether the admin can delete the specific order.
     */
    public function delete(Admin $admin, Order $order): bool
    {
        return $this->belongsToAdminShop($admin, $order);
    }

    /**
     * Helper method to verify if an order belongs to the admin's active/assigned shop.
     */
    private function belongsToAdminShop(Admin $admin, Order $order): bool
    {
        // Ensures the order's shop_id matches the logged-in admin's shop_id
        return $admin->shop_id !== null && (int) $admin->shop_id === (int) $order->shop_id;
    }
}