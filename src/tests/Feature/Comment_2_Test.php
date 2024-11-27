<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Comment_2_Test extends TestCase
{
    use RefreshDatabase;

    public function test_validation_message_is_displayed_when_comment_is_empty()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user);

        $response = $this->post(route('comment.store', ['item_id' => $item->id]), [
            'comment' => '',
        ]);

        $response->assertSessionHasErrors(['comment' => 'コメントを入力してください。']);
    }
}