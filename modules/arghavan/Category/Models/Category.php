<?php


namespace arghavan\Category\Models;


use Illuminate\Database\Eloquent\Model;
//use arghavan\ProductAttributes\Models\Image;

class Category extends Model
{
    protected $guarded = [];

    public function parentCategory()
    {
        return $this->belongsTo(Category::class,'parent_id');
    }

    public function subCategory()
    {
        return $this->hasMany(Category::class,'parent_id','id');
    }

    public function getParentAttribute()
    {
        return (is_null($this->parent_id)) ? 'ندارد' : $this->parentCategory->title;
    }

//    public function Attribute()
//    {
//        return $this->hasMany(Image::class);
//    }
}
