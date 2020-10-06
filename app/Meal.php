<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    protected $guarded = ['id'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

}
