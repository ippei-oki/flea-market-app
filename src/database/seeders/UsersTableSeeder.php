<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '山田太郎',
            'email' => 'aaa@example.com',
            'email_verified_at' => '2024-09-21 15:56:40',
            'password' => bcrypt('99999999'),
            'postal_code' => '123-4567',
            'address' => '東京都',
            'building' => 'メゾン山田',
            'profile_completed' => 1,
            'created_at' => '2024-09-21 15:56:40',
            'updated_at' => '2024-09-21 15:56:40'
        ];
        DB::table('users')->insert($param);

        $param = [
            'name' => '山田次郎',
            'email' => 'bbb@example.com',
            'email_verified_at' => '2024-09-21 15:56:40',
            'password' => bcrypt('99999999'),
            'postal_code' => '234-5678',
            'address' => '大阪府',
            'building' => '山田ハイツ',
            'profile_completed' => 1,
            'created_at' => '2024-09-21 15:56:40',
            'updated_at' => '2024-09-21 15:56:40'
        ];
        DB::table('users')->insert($param);
    }
}
