@extends('layouts.app')

@section('content')
<!-- Content for the main section -->
<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Cart
        </h2>
    </div>
</header>
@if ($cart)
<h2 class="max-w-7xl mx-auto flex px-10 py-10 gap-10 bg-gray-100 relative mt-5 font-bold">Products in Cart</h2>
<div class="max-w-7xl mx-auto flex px-10 py-10 gap-10 bg-white relative">
    @foreach ($cart->products as $product)
    <div class="bg-white px-4 py-4 rounded-lg w-60 pb-14 relative border-2 shadow-md mb-20">
        <div class="flex">
            <div class=" w-40 text-md">{{ $product->name }}</div>
            <div class="w-2 text-sm font-bold">${{ $product->price }}</div>
        </div>
        <div class="text-sm py-4 px-2">{{ $product->description }}</div>
        <form method="POST" action="{{ route('carts.destroy', $product->id) }}">
            @csrf
            @method('DELETE')
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <button class="border-2 border-yellow-500 rounded-lg py-2 px-2 bg-yellow-400 hover:bg-yellow-100 text-white hover:text-yellow-500 shadow-lg absolute bottom-4 left-3.5 right-3.5">Remove from Cart</button>
        </form>
    </div>
    @endforeach
    <span class="absolute bottom-6 inset-x-10">Total Cost: ${{ $cart->totalCost }}</span>
    @if($cart->products->count() > 0 )
    <div>
        <button class="border-2 border-green-500 rounded-lg py-2 px-2 bg-green-400 hover:bg-green-100 text-white hover:text-green-500 shadow-lg absolute bottom-4 right-3.5">Buy Cart</button>
    </div>
    @endif
</div>
@else
<p>No products in the cart.</p>
@endif
@endsection