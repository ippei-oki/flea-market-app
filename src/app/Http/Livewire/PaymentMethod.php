<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PaymentMethod extends Component
{
    public $payment_method;

    public function updatedPaymentMethod()
    {
        $this->emitUp('paymentMethodUpdated', $this->payment_method);
    }

    public function render()
    {
        return view('livewire.payment-method');
    }
}