<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $products = Product::where('user_id', '!=', $user_id)->get();

        return view('Markets.index', ['products' => $products]);
    }
}
