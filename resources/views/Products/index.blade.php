@extends('layouts.app')

@section('content')
<!-- Content for the main section -->
<header class="bg-white dark:bg-gray-800 shadow">
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Products
        </h2>
    </div>
</header>
<div class="bg-white max-w-7xl mx-auto h-24 px-4 py-4 mt-7 flex ">
    <a href={{route('products.create')}}>
        <button class="border-2 border-green-500 rounded-lg py-2 px-2 min-h-full bg-green-400 hover:bg-green-100 text-white hover:text-green-500 shadow-lg">Add Product</button>
    </a>

</div>

<div class="max-w-7xl mx-auto flex px-10 py-10 gap-10 bg-white flex-wrap">
    @foreach($products as $indexProduct => $product)

    <div class="bg-white px-4 py-4 rounded-lg w-60 pb-14 relative border-2 shadow-md">
        @if ($product->images->isNotEmpty())
        <div>
            <img src="{{ asset($product->images->first()->image_uri) }}" alt="Product Image">
        </div>
        @endif
        <div class="flex">
            <div class=" w-40 text-md">{{ $product->name }}</div>
            <div class="w-2 text-sm font-bold">${{ $product->price }}</div>
        </div>
        <div class="text-sm py-4 px-2">{{ $product->description }}</div>
        <a href="{{ route('products.edit', ['product' => $product->id]) }}">
            <button class="border-2 border-yellow-500 rounded-lg py-2 px-2 bg-yellow-400 hover:bg-yellow-100 text-white hover:text-yellow-500 shadow-lg absolute bottom-4 left-3.5 right-3.5">Edit</button>
        </a>
    </div>
    @endforeach
</div>
@endsection