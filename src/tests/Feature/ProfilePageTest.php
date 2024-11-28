<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProfilePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_displays_correct_initial_values_on_profile_page()
    {
        $user = User::factory()->create([
            'profile_image' => '/storage/profile_images/test_image.jpg',
            'name' => 'テストユーザー',
            'postal_code' => '123-4567',
            'address' => '東京都新宿区テスト町1-1-1',
            'building' => 'テストビル202',
        ]);

        $this->actingAs($user);

        $response = $this->get('/mypage/profile');

        $response->assertStatus(200);

        $response->assertSee('テストユーザー');
        $response->assertSee('123-4567');
        $response->assertSee('東京都新宿区テスト町1-1-1');
        $response->assertSee('テストビル202');
        $response->assertSee('/storage/profile_images/test_image.jpg');
    }
}