<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraRepaymentSchedule extends Model
{
    use HasFactory;
    protected $table = 'extra_repayment_schedule';

    protected $fillable = [
        'loan_amortization_id', 'month_number', 'starting_balance', 'monthly_payment', 'principal_component', 'interest_component','extra_repayment', 'ending_balance','remain_loan_term', 'remain_loan_balance'
    ];
}
