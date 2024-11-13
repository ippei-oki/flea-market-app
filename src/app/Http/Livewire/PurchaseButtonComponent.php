<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class PurchaseButtonComponent extends Component
{
    public $item;
    public $user;

    public function mount($item)
    {
        $this->item = $item;
        $this->user = Auth::user();
    }

    public function confirmPurchase()
    {
        $purchase = new Purchase();
        $purchase->user_id = $this->user->id;
        $purchase->item_id = $this->item->id;
        $purchase->save();

        return redirect()->route('home')->with('success', '購入が完了しました。');
    }

    public function render()
    {
        return view('livewire.purchase-button-component');
    }
}
