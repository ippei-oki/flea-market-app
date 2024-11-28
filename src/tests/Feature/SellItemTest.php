<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Condition;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SellItemTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_save_item_data_correctly()
    {
        Storage::fake('public');

        $user = User::factory()->create();
        $category = Category::factory()->create();
        $condition = Condition::factory()->create();

        $this->actingAs($user);

        $image = UploadedFile::fake()->image('product.jpg');

        $response = $this->post(route('sell.store'), [
            'name' => 'テスト商品',
            'explanation' => 'これはテスト商品です。',
            'image' => $image,
            'selectedCategories' => [$category->id],
            'condition' => $condition->id,
            'price' => 1000,
        ]);

        $this->assertDatabaseHas('items', [
            'name' => 'テスト商品',
            'explanation' => 'これはテスト商品です。',
            'price' => 1000,
            'condition_id' => $condition->id,
        ]);

        $filePath = "item_images/{$image->hashName()}";

        Storage::disk('public')->assertExists($filePath);

        $response->assertRedirect(route('home'));        
    }
}