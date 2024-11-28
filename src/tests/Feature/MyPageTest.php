<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use App\Models\Sell;
use App\Models\Purchase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MyPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_sell_items_by_default()
    {
        $user = User::factory()->create();
        $sellItem = Item::factory()->create([
            'user_id' => $user->id,
            'name' => 'テスト商品',
            'image' => 'item_images/sample.jpg',
        ]);
        Sell::factory()->create(['user_id' => $user->id, 'item_id' => $sellItem->id]);

        $this->actingAs($user);
        $response = $this->get(route('mypage.sell'));

        $response->assertStatus(200)
            ->assertSee('出品した商品')
            ->assertSee('active')
            ->assertSee($sellItem->name)
            ->assertSee($sellItem->image);
    }

    public function test_it_displays_purchase_items_when_tab_is_selected()
    {
        $user = User::factory()->create();
        $purchasedItem = Item::factory()->create(['name' => 'Purchased Item', 'image' => 'purchased_item.jpg']);
        Purchase::factory()->create(['user_id' => $user->id, 'item_id' => $purchasedItem->id]);

        $this->actingAs($user);
        $response = $this->get(route('mypage.purchase'));

        $response->assertStatus(200)
            ->assertSee('購入した商品')
            ->assertSee('active')
            ->assertSee($purchasedItem->name)
            ->assertSee($purchasedItem->image);
    }
}