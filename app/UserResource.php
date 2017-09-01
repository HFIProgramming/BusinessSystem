<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserResource extends Model
{
    //
    public function scopeId($query, $id)
    {
        return $query->where('id',id)->first();
    }
}
