<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $guarded = [];

    
	public function billings()
	{
        return $this->hasMany(Billing::class,'order_id');
    }

    public function product()
    {
        return $this->hasOne(Product::class,'id','product_id');
    }

    public function shipping()
	{
	    return $this->belongsTo(Shipping::class);
	}
}
