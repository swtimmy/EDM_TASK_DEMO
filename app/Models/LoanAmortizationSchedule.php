<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanAmortizationSchedule extends Model
{
    use HasFactory;

    protected $table = 'loan_amortization_schedule';

    protected $fillable = [
        'loan_amortization_id', 'month_number', 'starting_balance', 'monthly_payment', 'principal_component', 'interest_component', 'ending_balance'
    ];
}
