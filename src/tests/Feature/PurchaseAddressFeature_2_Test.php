<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PurchaseAddressFeature_2_Test extends TestCase
{
    use RefreshDatabase;

    public function test_it_links_shipping_address_to_purchase()
    {
        $user = User::factory()->create([
            'postal_code' => '000-0000',
            'address' => 'Initial Address',
            'building' => 'Initial Building',
        ]);

        $item = Item::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('purchase.address.update', ['item_id' => $item->id]), [
            'postal_code' => '123-4567',
            'address' => 'Test City, Test Street 123',
            'building' => 'Test Building 101',
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'postal_code' => '123-4567',
            'address' => 'Test City, Test Street 123',
            'building' => 'Test Building 101',
        ]);

        $response = $this->post(route('purchase.stripe.session', [
            'item_id' => $item->id,
            'payment_method' => 'card',
        ]));

        $response->assertStatus(302);

        $this->get(route('purchase.stripe.success', [
            'item_id' => $item->id,
        ]));        

        $this->assertDatabaseHas('purchases', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}