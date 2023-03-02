<?php

namespace arghavan\Models\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use arghavan\Media\Models\Media;
use Laravel\Passport\HasApiTokens;

class Models extends Model
{
    use HasFactory,HasApiTokens;

    protected $guarded = [];

}
