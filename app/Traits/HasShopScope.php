<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait HasShopScope
{

    public function scopeForShop(Builder $query, bool $includeGlobal = false, $admin = null, $activeShop = null): Builder
    {
        $admin = $admin ?? auth('admin')->user();
        $activeShop = $activeShop ?? request()->get('active_shop');

        // Superadmin without an active shop selected sees ALL items
        if ($admin && $admin->is_superadmin && !request()->has('active_shop')) {
            return $query;
        }

        if ($activeShop) {
            $shopId = is_object($activeShop) ? $activeShop->id : $activeShop;

            return $query->where(function ($q) use ($shopId, $includeGlobal) {
                $q->where($this->getTable() . '.shop_id', $shopId);

                if ($includeGlobal) {
                    $q->orWhereNull($this->getTable() . '.shop_id');
                }
            });
        }

        // If no active shop context exists, return global items if requested, or an empty result set
        return $includeGlobal 
            ? $query->whereNull($this->getTable() . '.shop_id') 
            : $query->whereRaw('1 = 0');
    }
}