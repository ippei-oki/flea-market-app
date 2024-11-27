<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Comment;

class Comment_1_Test extends TestCase
{
    use RefreshDatabase;

    public function test_logged_in_user_can_submit_a_comment_and_comment_count_increases()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->assertEquals(0, $item->comments->count());

        $this->actingAs($user);

        $commentData = [
            'comment' => 'この商品はとても良いです！',
        ];

        $response = $this->post(route('comment.store', ['item_id' => $item->id]), $commentData);

        $response->assertRedirect();
        $response->assertSessionHasNoErrors();

        $this->assertDatabaseHas('comments', [
            'user_id' => $user->id,
            'item_id' => $item->id,
            'comment' => $commentData['comment'],
        ]);

        $updatedItem = $item->refresh();
        $this->assertEquals(1, $updatedItem->comments->count());
    }

    public function test_guest_user_cannot_submit_a_comment()
    {
        $item = Item::factory()->create();

        $commentData = [
            'comment' => '未ログインユーザーのコメント',
        ];

        $response = $this->post(route('comment.store', ['item_id' => $item->id]), $commentData);

        $response->assertRedirect(route('login'));

        $this->assertDatabaseMissing('comments', [
            'comment' => $commentData['comment'],
        ]);
    }
}