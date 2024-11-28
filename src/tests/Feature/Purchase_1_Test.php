<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Purchase_1_Test extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_complete_a_purchase()
    {
        $user = User::factory()->create([
            'postal_code' => '1234567',
            'address' => '東京都渋谷区',
        ]);
        $item = Item::factory()->create();

        $this->actingAs($user);

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