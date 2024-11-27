<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use App\Models\Condition;
use App\Models\Comment;

class ItemDetail_1_Test extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_all_required_information_on_item_detail_page()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['name' => 'Electronics']);
        $condition = Condition::factory()->create(['condition' => 'New']);
        $item = Item::factory()->create([
            'name' => 'Sample Item',
            'brand' => 'Sample Brand',
            'price' => 1000,
            'image' => 'sample.jpg',
            'explanation' => 'This is a sample item.',
            'condition_id' => $condition->id,
        ]);

        $item->categories()->attach($category->id);

        Comment::factory()->count(2)->create([
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => 'Great product!',
        ]);

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);
        $response->assertSee($item->name);
        $response->assertSee($item->brand);
        $response->assertSee($item->price);
        $response->assertSee('sample.jpg');
        $response->assertSee($item->explanation);
        $response->assertSee('Electronics');
        $response->assertSee('New');
        $response->assertSee('2');
        $response->assertSee('Great product!');
        $response->assertSee($user->name);
    }
}
