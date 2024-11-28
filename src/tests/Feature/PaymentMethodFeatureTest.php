<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentMethodFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_user_can_select_a_payment_method_and_see_it_reflected_on_the_purchase_details_page()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create([
            'price' => 5000,
        ]);

        $this->actingAs($user);

        $response = $this->get(route('purchase.details', ['item_id' => $item->id]));
        $response->assertStatus(200);
        $response->assertSee('未選択');

        Livewire::test(\App\Http\Livewire\PurchaseComponent::class, ['item' => $item])
            ->set('payment_method', 'card');

        $response = $this->get(route('purchase.details', ['item_id' => $item->id]));
        $response->assertStatus(200);
        $response->assertSee('カード支払い');
    }
}