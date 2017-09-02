<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    //
    public function scopeKeyValue($query, $key)
    {
        return $query->where('key', $key)->firstOrFail();
    }
}
