<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\LoanAmortizationSchedule as LoanAmortizationSchedule;
use App\Models\LoanAmortization as LoanAmortization;
use App\Models\ExtraRepaymentSchedule as ExtraRepaymentSchedule;

class Form extends Component
{
    public $loan_amount;
    public $annual_interest_rate;
    public $loan_term;
    public $extra = false;
    public $monthly_fixed_extra_payment = false;

    public $total_month;
    public $monthly_interest_rate;
    public $loanId;

    public function mount($loanId=false){
        $this->loanId = $loanId;
        if($loan = LoanAmortization::find($loanId)){
            $this->loan_amount = round($loan->loan_amount,2);
            $this->annual_interest_rate = round($loan->interest_rate,2);
            $this->loan_term = $loan->loan_term;
            if($loan->monthly_fixed_extra_payment>0){
                $this->extra = true;
                $this->monthly_fixed_extra_payment = round($loan->monthly_fixed_extra_payment,2);
            }
        }
    }

    protected $rules = [
        'loan_amount' => 'required|integer|between:1,9999999999999999999|min:1',
        'annual_interest_rate' => ['required','numeric','between:0,100','min:0','regex:/^(?:[1-9]\d+|\d)(?:\.\d\d)?$/'],
        'loan_term' => 'required|integer|between:1,999|min:1',
    ];

    protected $messages = [
        'annual_interest_rate.regex'=>'The :attribute just allow 0 to 2 decimal.',
        'monthly_fixed_extra_payment.regex'=>'The :attribute just allow 0 to 1 decimal.'
    ];

    protected function calculate($end_balance, $monthly_interest_rate, $number_of_months, $monthly_fixed_extra_payment=0){
        $data = [];
        $count = 0;
        $remain_loan_balance = $end_balance;
        $monthly_payment = ($end_balance*$monthly_interest_rate) / ( 1 - pow((1+$monthly_interest_rate),(($number_of_months-$count)*-1)));
        while($remain_loan_balance>0){
            $start_balance = $end_balance;
            $start_remain_loan_balance = $remain_loan_balance;
            $insterest = $remain_loan_balance*$monthly_interest_rate;
            $principal = $monthly_payment - $insterest;
            $end_balance = $end_balance-$principal;
            $remain_loan_balance = $remain_loan_balance-$principal;
            $remain_loan_balance = $remain_loan_balance-$monthly_fixed_extra_payment;
            $end_balance = ($end_balance<0)?0:$end_balance;
            $remain_loan_balance = ($remain_loan_balance<0)?0:$remain_loan_balance;
            $data[$count]=[
                'month'=>$count+1,
                'start_balance'=> $start_balance,
                'interest'=> $insterest,
                'monthly_payment'=> $monthly_payment,
                'principal'=> ($principal+ $monthly_fixed_extra_payment > $start_remain_loan_balance)?$start_remain_loan_balance:$principal+ $monthly_fixed_extra_payment,
                'extra_repayment'=>($monthly_fixed_extra_payment && $start_remain_loan_balance >= $principal+ $monthly_fixed_extra_payment)?$monthly_fixed_extra_payment:false,
                'end_balance'=> $end_balance,
                'remain_loan_balance' => $remain_loan_balance,
            ];
            $count++;
        }
        foreach($data as &$value){
            $value['remain_loan_term'] = $count - $value['month'];
        }
        unset($value);
        return $data;
    }

    public function submit()
    {
        if($this->extra){
            $this->rules['monthly_fixed_extra_payment'] = ['numeric','between:1,9999999999999999999','min:0','regex:/^(?:[1-9]\d+|\d)(?:\.\d)?$/'];
        }else{
            $this->monthly_fixed_extra_payment=0;
        }
        
        $this->validate();
        $this->total_month = $this->loan_term*12;
        $this->monthly_interest_rate = ($this->annual_interest_rate/12)/100;

        $name = "la".$this->loan_amount."air".$this->annual_interest_rate."lt".$this->loan_term.(($this->monthly_fixed_extra_payment)?"mfep".$this->monthly_fixed_extra_payment:"");

        if(!$data = LoanAmortization::where('loan_name',$name)->first()){
            $data = LoanAmortization::create(['loan_name'=>$name,'loan_amount'=>$this->loan_amount,'loan_term'=>$this->loan_term,'interest_rate'=>$this->annual_interest_rate,'monthly_fixed_extra_payment'=>$this->monthly_fixed_extra_payment]);
            
            $list = $this->calculate($this->loan_amount, $this->monthly_interest_rate, $this->total_month, $this->monthly_fixed_extra_payment);
            
            foreach($list as $index=>$value){
                if($this->monthly_fixed_extra_payment){
                    ExtraRepaymentSchedule::create([
                        'loan_amortization_id'=> $data->id,
                        'month_number'=> $value['month'],
                        'starting_balance'=> $value['start_balance'],
                        'monthly_payment'=> $value['monthly_payment'],
                        'principal_component'=> $value['principal'],
                        'interest_component'=> $value['interest'],
                        'extra_repayment'=>  $value['extra_repayment'],
                        'ending_balance'=> $value['end_balance'],
                        'remain_loan_balance'=>$value['remain_loan_balance'],
                        'remain_loan_term'=>  $value['remain_loan_term'],
                    ]);
                }else{
                    LoanAmortizationSchedule::create([
                        'loan_amortization_id'=> $data->id,
                        'month_number'=> $value['month'],
                        'starting_balance'=> $value['start_balance'],
                        'monthly_payment'=> $value['monthly_payment'],
                        'principal_component'=> $value['principal'],
                        'interest_component'=> $value['interest'],
                        'ending_balance'=> $value['end_balance'],
                    ]);
                }
            }
        }
        $this->emit('updateTable',['id'=>$data->id]);
        $this->emit('formDone');
        // return redirect()->to('/form');
    }

    public function render()
    {
        return view('livewire.form');
    }
}
