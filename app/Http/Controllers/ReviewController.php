<?php

namespace App\Http\Controllers;

use App\Model\Review;
use Illuminate\Http\Request;
use App\Http\Resources\Review\ReviewResource;
use App\Http\Requests\ReviewRequest;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\App\Model\Product $product)
    {
        return ReviewResource::collection($product->reviews);
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
     * @param \App\Http\Requests\ReviewRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ReviewRequest $request, \App\Model\Product $product)
    {
        
        // $review = Review::create([
        //     'customer' => $request->customer,
        //     'review' => $request->review,
        //     'star' => $request->star,
        //     'product_id' => $product->id
        // ]);
        
        // the next code is the same of above

        $review = new Review($request->all());

        $product->reviews()->save($review);

        return response()->json([
            'review' => new ReviewResource($review),
            'status' => '200 ok'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function show(Review $review)
    {
        return new ReviewResource(Review::find($review));        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,\App\Model\Product $product, Review $review)
    {
        $review->update($request->all());
        return response()->json([
            'review' => new ReviewResource($review),
            'status' => '200 ok'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Review  $review
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Model\Product $product, Review $review)
    {
        $review->delete();
        return response()->json([
            'status' => '200 ok',
            'descreption' => 'review deleted success'
        ], 204);
    }
}
