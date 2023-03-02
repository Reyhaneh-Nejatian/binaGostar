<?php

namespace arghavan\Brands\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use arghavan\Media\Models\Media;

class Brand extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
}
