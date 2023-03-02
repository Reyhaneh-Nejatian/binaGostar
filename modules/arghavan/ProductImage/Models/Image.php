<?php


namespace arghavan\ProductImage\Models;


use Illuminate\Database\Eloquent\Model;
use arghavan\Media\Models\Media;
use arghavan\Product\Models\Product;

class Image extends Model
{
    protected $guarded = [];

    protected $table = 'product_images';

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
}
