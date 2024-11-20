<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        $tab = 'sell';

        $sellItems = Item::where('user_id', $user->id)->get();

        return view('mypage', compact('user', 'sellItems', 'tab'));
    }

    public function edit()
    {
        return view('profile.edit');
    }

    public function update(AddressRequest $addressRequest, ProfileRequest $profileRequest)
    {
        $user = Auth::user();

        if ($profileRequest->hasFile('profile_image')) {
            $imageName = time() . '.' . $profileRequest->profile_image->extension();
            $profileRequest->profile_image->storeAs('public/profile_images', $imageName);
            $user->profile_image = '/storage/profile_images/' . $imageName;
        }

        $user->name = $addressRequest->name;
        $user->postal_code = $addressRequest->postal_code;
        $user->address = $addressRequest->address;
        $user->building = $addressRequest->building;
        $user->profile_completed = true;
        $user->save();

        return redirect()->route('home');
    }

    public function showSellItems()
    {
        $user = auth()->user();
        $sellItems = Item::where('user_id', $user->id)->get();
        return view('mypage', compact('user', 'sellItems'))->with('tab', 'sell');
    }

    public function showPurchasedItems()
    {
        $user = auth()->user();
        $purchasedItems = Item::whereIn('id', $user->purchases->pluck('id'))->get();
        return view('mypage', compact('user', 'purchasedItems'))->with('tab', 'purchase');
    }
}