<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseRequest;

class PurchaseController extends Controller
{
    public function purchase($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        return view('purchase', compact('item', 'user'));
    }

    public function confirmPurchase(PurchaseRequest $request, $item_id)
    {
        \Log::info("confirmPurchase method reached for item_id: $item_id");
        
        $user = Auth::user();
        $item = Item::findOrFail($item_id);

        $purchase = new Purchase();
        $purchase->user_id = $user->id;
        $purchase->item_id = $item->id;
        $purchase->save();

        return redirect()->route('home')->with('success', '購入が完了しました。');
    }
}