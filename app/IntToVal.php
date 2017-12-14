<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntToVal extends Model
{
    //
    protected $table = 'interval_to_value';

    public function scopeIntervalValue($query, $flag, $value)
    {
        return $query->where('flag', $flag)->where('lower', '<=', $value)->where('upper', '>', $value)->first();
    }
}
