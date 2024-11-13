<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Subtotal extends Component
{
    public $subtotal;
    public $paymentMethod = '';

    protected $listeners = ['paymentMethodUpdated' => 'updateSubtotal'];

    public function mount($item)
    {
        $this->subtotal = $item->price;
    }

    public function updateSubtotal($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
    }

    public function render()
    {
        return view('livewire.subtotal');
    }
}
