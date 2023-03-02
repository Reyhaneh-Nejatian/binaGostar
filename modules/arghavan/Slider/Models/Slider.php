<?php

namespace arghavan\Slider\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use arghavan\Media\Models\Media;

class Slider extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }
}
