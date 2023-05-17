<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAmortization extends Model
{
    use HasFactory;
    protected $table = 'loan_amortization';

    protected $fillable = [
        'loan_name',
        'loan_amount',
        'loan_term',
        'interest_rate',
        'monthly_fixed_extra_payment'
    ];
}
