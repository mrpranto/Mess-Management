<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $guarded = ['id'];

    public function meals()
    {
        return $this->hasMany(Meal::class);
    }

    public function bazars()
    {
        return $this->hasMany(Bazar::class);
    }
}
