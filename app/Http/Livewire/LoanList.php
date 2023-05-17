<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\LoanAmortization as LoanAmortization;

class LoanList extends Component
{
    public $loanId;

    public function mount(){
        $this->loanId = false;
    }

    public function goto($id){
        $this->loanId = $id;
    }

    public function back(){
        $this->loanId = false;
    }

    public function update($id){
        redirect()->route('home.loan_id',['loan_id'=>$id]);
    }

    public function render()
    {
        return view('livewire.loan-list',['data'=>LoanAmortization::All()]);
    }
}
