<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Images;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = auth()->id();
        $products = Product::where('user_id', '=', $user_id)->available()->NotSold()->with('images')->get();

        return view('Products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {

        $data = $request->validated();
        $data['user_id'] = auth()->id();
        try {
            $product = Product::create($data);

            if ($request->file()) {
                foreach ($request->file('images') as $keyFile => $file) {
                    try {
                        $path = $file->store('public/ProductImages');
                        $uri = \Illuminate\Support\Facades\Storage::url($path);
                    } catch (\Exception $e) {
                        dd($e->getMessage());
                    }

                    $name = $file->getClientOriginalName();
                    $dataImage['name'] = $name;
                    $dataImage['product_id'] = $product->id;
                    $dataImage['image_uri'] = $uri;

                    Images::create($dataImage);
                }
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }


        return redirect()->route('products.index');
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
        $product = Product::findOrFail($id);

        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);
        $product->update($request->validated());

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
