<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Item;
use App\Models\Purchase;

class StripeController extends Controller
{
    public function createSession(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $item = Item::findOrFail($request->item_id);

        $session = Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'jpy',
                    'product_data' => [
                        'name' => $item->name,
                    ],
                    'unit_amount' => $item->price,
                ],
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => route('purchase.stripe.success', ['item_id' => $item->id]),
            'cancel_url' => route('home'),
        ]);

        return redirect($session->url);
    }

    public function success($item_id)
    {
        $user = auth()->user();

        Purchase::create([
            'user_id' => $user->id,
            'item_id' => $item_id,
        ]);

        return redirect()->route('home')->with('success', '購入が完了しました。');
    }
}
