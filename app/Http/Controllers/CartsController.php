<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;
use App\Services\CartService;


class CartsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->id();

        $cart = Cart::where('user_id', $user_id)->first();
        $totalCost = CartService::calculateTotalCost($cart);
        $cart->totalCost = $totalCost;

        return view('Carts.index', ['cart' => $cart]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = Auth()->id();
        $product_id = $request->product_id;

        $cart = Cart::findByUserId($user_id);
        if (!$cart) {
            $cart = new Cart();
            $cart->user_id = $user_id;
            $cart->save();
        }
        $cart->products()->attach($product_id);
        $data_product['available'] = false;
        Product::where('id', $product_id)->update($data_product);

        return redirect()->route('market.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth()->id();
        $product_id = $id;

        $cart = Cart::findByUserId($user_id);
        $cart->products()->detach($product_id);
        $totalCost = CartService::calculateTotalCost($cart);
        $cart->totalCost = $totalCost;

        $data_product['available'] = true;
        Product::where('id', $product_id)->update($data_product);

        return redirect()->route('carts.index');
    }
}
