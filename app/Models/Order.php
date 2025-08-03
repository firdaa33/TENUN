<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'payment_method',
        'bukti_transfer',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function returnRequest()
    {
        return $this->hasOne(ReturnRequest::class);
    }
    public function return_request()
    {
    return $this->hasOne(\App\Models\ReturnRequest::class);
    }

}
