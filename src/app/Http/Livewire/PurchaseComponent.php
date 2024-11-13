<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseComponent extends Component
{
    public $item;
    public $user;
    public $payment_method;

    public function mount($item)
    {
        $this->item = $item;
        $this->user = Auth::user();
    }

    protected $rules = [
        'payment_method' => 'required'
    ];

    public function updatedPaymentMethod($value)
    {
        $this->emit('paymentMethodUpdated', $value);
    }

    public function render()
    {
        return view('livewire.purchase-component');
    }
}