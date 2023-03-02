<?php

namespace arghavan\Payment\Models;


use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $guarded = [];

    protected $table = 'addresses';

    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
