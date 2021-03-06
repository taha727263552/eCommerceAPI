<?php

namespace App\Http\Controllers;

use App\Model\Product;
use Illuminate\Http\Request;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Http\Requests\ProductRequest;
use Auth;
use App\Exceptions\productNotBelongsToUser;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return new ProductCollection(Product::paginate(5));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $product = new Product();

        $product->name = $request->name;
        $product->detail = $request->detail;
        $product->stock = $request->stock;
        $product->discount = $request->discount;
        $product->price = $request->price;
        $product->user_id = $request->user_id;
        
        $product->save();

        return response()->json([
            'data' => new ProductResource($product),
            'status' => '200 ok',
            'descreption' => 'product insret success'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {

        // return $product->user_id == Auth::id() ? 'true' : 'false';
        // $this->authorize('update', $product);
        $this->productCheckBelongsTo($product);

        // $productupdate = Product::findOrFail($product->id);
        
        // $productupdate->name = $request->name;
        // $productupdate->detail = $request->detail;
        // $productupdate->stock = $request->stock;
        // $productupdate->discount = $request->discount;
        // $productupdate->price = $request->price;
        
        // $productupdate->save();

        // is the same thing upp == down
        $product->update($request->all());
        return response()->json([
            'data' => new ProductResource($product),
            'status' => '200 ok',
            'descreption' => 'product update success'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json([
            'status' => '200 ok',
            'descreption' => 'product deleted success'
        ], 204);
    }
 
    public function productCheckBelongsTo(Product $product)
    {
        if(Auth::id() !== $product->user_id)
            throw new productNotBelongsToUser;
    }
}
