<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];
    public $timestamps = false;

    public function likeable()
    {
        return $this->morphTo();
    }
}
