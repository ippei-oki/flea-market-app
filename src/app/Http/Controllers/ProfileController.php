<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddressRequest;
use App\Http\Requests\ProfileRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
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
}
