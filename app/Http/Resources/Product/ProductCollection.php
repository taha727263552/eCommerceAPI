<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Review\ReviewResource;

class ProductCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($product)
                {
                    return [
                        'name' => $product->name,
                        'more_detail' => route('products.show', $product->id),
                        'reviews' => ReviewResource::collection($product->reviews),
                    ];
                }),
        ];
    }
}
