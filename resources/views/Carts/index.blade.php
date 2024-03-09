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
<h2>Products in Cart</h2>
<ul>
    @foreach ($cart->products as $product)
    <li>{{ $product->name }} - {{ $product->price }}</li>
    @endforeach
</ul>
@else
<p>No products in the cart.</p>
@endif
@endsection