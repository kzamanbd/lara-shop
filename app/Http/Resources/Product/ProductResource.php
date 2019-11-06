<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'name'      =>$this->name,
            'category'  =>$this->category->name,
            'price'     =>$this->product_price,
            'sale_price'=>$this->sale_price,
            'discount'  => number_format($this->product_price - $this->sale_price,2,'.',','),
            'color'     =>$this->product_color,
            'alert_quantity' =>$this->alert_quantity,
            'quantity'  =>$this->quantity==0?'Stok Out Product':$this->quantity,
            'description'  =>$this->product_description,
            'image' =>$this->product_image,
            'status' =>$this->status,
            'created_at' =>$this->created_at,
            'updated_at' =>$this->updated_at,
            'href' =>[
                'add_to_cart' => route('carts.store',$this->id),
                'back' => route('products.index'),
            ],
        ];
    }
}
