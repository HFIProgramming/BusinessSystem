<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    public function loanTransaction()
    {
        return $this->belongsTo(Transaction::class, 'loan_transaction_id');
    }
}
