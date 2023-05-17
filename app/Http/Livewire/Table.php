<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\LoanAmortization as LoanAmortization;
use App\Models\LoanAmortizationSchedule as LoanAmortizationSchedule;
use App\Models\ExtraRepaymentSchedule as ExtraRepaymentSchedule;

class Table extends Component
{
    public $loanId;
    public $loan;
    public $type;
    protected $listeners = ['updateTable'=>'updateLoanId'];

    public function mount(){
        $this->loan = false;
    }
    public function updateLoanId($data){
        $this->loanId = $data['id'];
    }

    public function render()
    {
        $data = false;
        if($this->loanId){
            $this->loan = LoanAmortization::find($this->loanId);
            $this->loan->total_interest = 0;
            $this->loan->total_monthly_payment = 0;
            
            if($this->loan){
                if(LoanAmortizationSchedule::where("loan_amortization_id",$this->loanId)->count()>0){
                    $this->type = "normal";
                    $data = LoanAmortizationSchedule::where("loan_amortization_id",$this->loanId)->get();
                    foreach($data as $value){
                        $this->loan->total_interest += $value->interest_component;
                        $this->loan->total_monthly_payment += $value->monthly_payment;
                    }
                }else if(ExtraRepaymentSchedule::where("loan_amortization_id",$this->loanId)->count()>0){
                    $this->type = "extra";
                    $this->loan->total_extra_payment = 0;
                    $data = ExtraRepaymentSchedule::where("loan_amortization_id",$this->loanId)->get();
                    foreach($data as $value){
                        $this->loan->total_interest += $value->interest_component;
                        $this->loan->total_extra_payment += $value->extra_repayment;
                    }
                }
            }
            $this->loan->years = count($data);
        }
        return view('livewire.table',['data'=>$data]);
    }
}
