<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    public function scopeValue($query, $key)
    {
        return $query->where('key', $key)->firstOrFail();
    }
}
