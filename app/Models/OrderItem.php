<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    /* RELASI */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

   public function product()
    {
    return $this->belongsTo(\App\Models\Product::class);
    }
    public function rating()
    {
    return $this->hasOne(\App\Models\ProductRating::class);
    }

}
