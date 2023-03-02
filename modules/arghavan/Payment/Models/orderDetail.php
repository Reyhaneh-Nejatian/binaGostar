<?php

namespace arghavan\Payment\Models;


use arghavan\Product\Models\Product;
use arghavan\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class orderDetail extends Model
{
    protected $table = 'order-details';
    protected $guarded = [];

    public function buyer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
