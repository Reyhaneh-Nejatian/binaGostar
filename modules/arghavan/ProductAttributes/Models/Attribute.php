<?php


namespace arghavan\ProductAttributes\Models;


use Illuminate\Database\Eloquent\Model;
use arghavan\Product\Models\Product;

class Attribute extends Model
{
    protected $guarded = [];

    protected $table = 'product_attributes';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
