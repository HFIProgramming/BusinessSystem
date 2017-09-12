<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    //
    protected $fillable = ['user_id', 'type', 'level'];
}
