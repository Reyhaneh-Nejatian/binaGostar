<?php

namespace arghavan\Payment\Models;


use arghavan\Product\Models\Product;
use arghavan\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    const STATUS_PAID = "paid";
    const STATUS_UNPAID = "unpaid";
    const STATUS_CANCELED = "canceled";
    const STATUS_PENDING = "pending";

    public static $statuses = [
        self::STATUS_PAID,
        self::STATUS_UNPAID,
        self::STATUS_CANCELED,
        self::STATUS_PENDING,

    ];

    const TYPE_PREPARING = "preparing";
    const TYPE_POSTED = "posted";
    const TYPE_DELIVERED = "delivered";

    public static $type = [
        self::TYPE_PREPARING,
        self::TYPE_POSTED,
        self::TYPE_DELIVERED,

    ];

    public function buyer()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class,'address_id');
    }

    public function codes()
    {
        return $this->hasMany(Code::class,'order_id','id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }

}
