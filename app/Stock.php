<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    //
    protected $table = 'stocks';

    protected $casts = [
      'history_prices' => 'array',
      'up_poly_coeff' => 'array',
      'down_poly_coeff' => 'array'
    ];

    public function sellPrice() //卖盘卖出价 上升
    {
        return $this->calculatePriceFromPolyCoeffs($this->up_poly_coeff);
    }

    public function buyPrice() //买盘买入价 下降
    {
        return $this->calculatePriceFromPolyCoeffs($this->down_poly_coeff);
    }

    protected function calculatePriceFromPolyCoeffs($coeffs)
    {
        $current = $this -> current_price;
        $sum = 0;
        for($i=0;$i<count($coeffs);$i++)
        {
            $sum += $coeffs[$i] * pow($current,$i);
        }
        return $sum;
    }

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function resource()
    {
        return $this->belongsTo('App\Resource');
    }

    public function availableInMarket()
    {
        return User::type(0)->first()->resources()->resid($this->resource->id)->first()->amount;
    }

    public function riskIndex()
    {
        return $this->total*$this->current_price/$this->company->last_year_profit;//@TODO Check if rounded
    }
}
