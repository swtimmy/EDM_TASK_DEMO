<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Home extends Component
{

    public $loan_id;

    public function mount($loan_id = false)
    {
        $this->loan_id = $loan_id;
    }

    public function render()
    {
        return view('livewire.home');
    }
}
