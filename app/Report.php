<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    //
    protected $fillable = [
        'year', 'user_id', 'type', 'components', 'stock_price', 'profit', 'loan_total', 'buildings', 'tax', 'unredeemed_loan'
    ];

    protected $casts = [
        'components' => 'array',
        'buildings' => 'array'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
