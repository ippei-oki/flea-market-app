<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AddressRequest;
use App\Models\Item;

class AddressController extends Controller
{
    public function edit($item_id)
    {
        $item = Item::findOrFail($item_id);
        $user = Auth::user();

        return view('address', compact('item', 'user'));
    }

    public function update(AddressRequest $request, $item_id)
    {
        $user = Auth::user();

        $user->postal_code = $request->postal_code;
        $user->address = $request->address;
        $user->building = $request->building;
        if ($user->save()) {
            return redirect()->route('purchase', ['item_id' => $item_id])
                            ->with('success', '配送先住所が更新されました。');
        } else {
            return redirect()->back()->with('error', '住所の更新に失敗しました。');
        }
    }
}