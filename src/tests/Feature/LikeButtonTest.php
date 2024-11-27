<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Like;
use Livewire\Livewire;

class LikeButtonTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_like_an_item_using_livewire_component()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user);

        Livewire::test('like-button', ['item' => $item])
            ->assertSeeHtml('<img src="' . url('/storage/icon_images/like_std.jpg') . '"')
            ->assertSet('isLiked', false)
            ->assertSet('likeCount', 0)
            ->call('toggleLike')
            ->assertSeeHtml('<img src="' . url('/storage/icon_images/like_add.jpg') . '"')
            ->assertSet('isLiked', true)
            ->assertSet('likeCount', 1);

        $this->assertDatabaseHas('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }

    public function test_user_can_unlike_an_item_using_livewire_component()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();
        Like::create(['user_id' => $user->id, 'item_id' => $item->id]);

        $this->actingAs($user);

        Livewire::test('like-button', ['item' => $item])
            ->assertSeeHtml('<img src="' . url('/storage/icon_images/like_add.jpg') . '"')
            ->assertSet('isLiked', true)
            ->assertSet('likeCount', 1)
            ->call('toggleLike')
            ->assertSeeHtml('<img src="' . url('/storage/icon_images/like_std.jpg') . '"')
            ->assertSet('isLiked', false)
            ->assertSet('likeCount', 0);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $user->id,
            'item_id' => $item->id,
        ]);
    }
}