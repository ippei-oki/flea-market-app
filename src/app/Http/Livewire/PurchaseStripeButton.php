<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PurchaseStripeButton extends Component
{
    public $item;

    public function purchase()
    {
        return redirect()->route('purchase.stripe.session', ['item_id' => $this->item->id]);
    }

    public function render()
    {
        return view('livewire.purchase-stripe-button');
    }
}
