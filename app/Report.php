<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'year', 'user_id', 'type', 'components', 'stock_price', 'profit', 'loan_total'
    ];

    protected $casts = [
        'components' => 'array'
    ];
}
