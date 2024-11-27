<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class Comment_3_Test extends TestCase
{
    use RefreshDatabase;

    public function test_validation_message_is_displayed_when_comment_exceeds_255_characters()
    {
        $user = User::factory()->create();
        $item = Item::factory()->create();

        $this->actingAs($user);

        $longComment = str_repeat('a', 256);

        $response = $this->post(route('comment.store', ['item_id' => $item->id]), [
            'comment' => $longComment,
        ]);

        $response->assertSessionHasErrors(['comment' => 'コメントは最大255文字までです。']);
    }
}