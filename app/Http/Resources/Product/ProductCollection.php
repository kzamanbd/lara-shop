<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCollection extends JsonResource
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
            'name' => $this->name,
            'category' => $this->category->name,
            'price' => $this->product_price,
            'quantity' => $this->quantity == 0 ? 'Stok Out Product' : $this->quantity,
            'image' => $this->image,
            'href' => [
                'url' => route('products.show', $this->id),
            ],
        ];
    }
}
