<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    //
    protected $fillable = [
        'debtor_id', 'creditor_id', 'loan_transaction_id', 'amount', 'interest'
    ];

    public function loanTransaction()
    {
        return $this->belongsTo(Transaction::class, 'loan_transaction_id');
    }

    public function creditor()
    {
        return $this->belongsTo(User::class, 'creditor_id');
    }

    public function debtor()
    {
        return $this->belongsTo(User::class, 'debtor_id');
    }
}
