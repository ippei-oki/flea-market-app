<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PurchaseAddressFeature_1_Test extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_change_delivery_address_and_see_updated_address_on_purchase_page()
    {
        $user = User::factory()->create([
            'postal_code' => '123-4567',
            'address' => '東京都新宿区1-1-1',
            'building' => 'ビル101',
        ]);

        $item = Item::factory()->create([
            'price' => 5000,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('purchase.details', ['item_id' => $item->id]));
        $response->assertStatus(200);
        $response->assertSee('123-4567');
        $response->assertSee('東京都新宿区1-1-1');
        $response->assertSee('ビル101');

        $newAddressData = [
            'postal_code' => '987-6543',
            'address' => '大阪府大阪市2-2-2',
            'building' => 'マンション202',
        ];

        $response = $this->post(route('purchase.address', ['item_id' => $item->id]), $newAddressData);

        $response->assertRedirect(route('purchase.details', ['item_id' => $item->id]));

        $response = $this->get(route('purchase.details', ['item_id' => $item->id]));
        $response->assertStatus(200);
        $response->assertSee('987-6543');
        $response->assertSee('大阪府大阪市2-2-2');
        $response->assertSee('マンション202');
    }
}