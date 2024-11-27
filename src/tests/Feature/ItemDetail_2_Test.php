<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Item;
use App\Models\Category;

class ItemDetail_2_Test extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_all_selected_categories_on_item_detail_page()
    {
        $item = Item::factory()->create(['name' => 'Sample Item']);
        $categories = Category::factory()->count(3)->create();

        $item->categories()->attach($categories->pluck('id'));

        $response = $this->get('/item/' . $item->id);

        $response->assertStatus(200);

        foreach ($categories as $category) {
            $response->assertSee($category->name);
        }
    }
}