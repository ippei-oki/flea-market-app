<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class Registration_1_Test extends TestCase
{
    use RefreshDatabase;

    public function test_name_is_required()
    {
        $data = [
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->post('/register', $data);

        $response->assertSessionHasErrors([
            'name' => 'お名前を入力してください',
        ]);
    }
}