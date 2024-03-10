<?php

namespace App\Services;

use App\Models\Cart;

class CartService
{
    public static function calculateTotalCost(Cart $cart)
    {
        $totalCost = 0;

        foreach ($cart->products as $product) {
            $totalCost += $product->price;
        }

        return $totalCost;
    }
}
