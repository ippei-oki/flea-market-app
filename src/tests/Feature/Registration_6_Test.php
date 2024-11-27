<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\UploadedFile;

class Registration_6_Test extends TestCase
{
    use RefreshDatabase;

    public function test_user_registration_process_works_correctly()
    {
        $this->app['config']->set('app.url', 'http://localhost');

        Notification::fake();

        $registrationData = [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $response = $this->post('/register', $registrationData);

        $response->assertRedirect('/email/verify');

        $user = User::where('email', $registrationData['email'])->first();
        $this->assertNotNull($user, '登録されたユーザーが存在しません');

        Notification::assertSentTo(
            $user, 
            \Illuminate\Auth\Notifications\VerifyEmail::class
        );

        $user->email_verified_at = now();
        $user->save();

        $this->actingAs($user)
            ->get('/mypage/profile')
            ->assertStatus(200);

        $file = UploadedFile::fake()->image('profile.jpg');

        $profileData = [
            'name' => '山田太郎',
            'profile_image' => $file,
            'postal_code' => '123-4567',
            'address' => '東京都',
            'building' => '山田ハイツ',
        ];

        $response = $this->actingAs($user)
            ->post('/mypage/profile', $profileData);

        $response->assertRedirect(route('login.get'));
    }
}