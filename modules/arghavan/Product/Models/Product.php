<?php


namespace arghavan\Product\Models;


use arghavan\ProductAttributes\Models\Attribute;
use arghavan\ProductImage\Models\Image;
use Illuminate\Database\Eloquent\Model;
use arghavan\Category\Models\Category;
use arghavan\Media\Models\Media;

class Product extends Model
{
    protected $guarded = [];

    const CONFIRMATION_STATUS_ACCEPTED = 'accepted';
    const CONFIRMATION_STATUS_REJECTED = 'rejected';
    const CONFIRMATION_STATUS_PENDING = 'pending';
    static $confirmationStatuses = [
        self::CONFIRMATION_STATUS_ACCEPTED,
        self::CONFIRMATION_STATUS_REJECTED,
        self::CONFIRMATION_STATUS_PENDING
    ];

    public function image()
    {
        return $this->belongsTo(Media::class,'image_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function productImage()
    {
        return $this->hasMany(Image::class);
    }
    public function productAttribute()
    {
        return $this->hasMany(Attribute::class);
    }


}
