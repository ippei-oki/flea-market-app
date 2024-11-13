<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'name' => '腕時計',
            'price' => 15000,
            'explanation' => 'スタイリッシュなデザインのメンズ腕時計',
            'image' => 'Watch.jpg',
            'condition_id' => 4
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'HDD',
            'price' => 5000,
            'explanation' => '高速で信頼性の高いハードディスク',
            'image' => 'HDD.jpg',
            'condition_id' => 3
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '玉ねぎ3束',
            'price' => 300,
            'explanation' => '新鮮な玉ねぎ3束のセット',
            'image' => 'Onion.jpg',
            'condition_id' => 2
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => '革靴',
            'price' => 4000,
            'explanation' => 'クラシックなデザインの革靴',
            'image' => 'Leather_shoes.jpg',
            'condition_id' => 1
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ノートPC',
            'price' => 45000,
            'explanation' => '高性能なノートパソコン',
            'image' => 'Laptop.jpg',
            'condition_id' => 4
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'マイク',
            'price' => 8000,
            'explanation' => '高音質のレコーディング用マイク',
            'image' => 'Microphone.jpg',
            'condition_id' => 3
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'ショルダーバッグ',
            'price' => 3500,
            'explanation' => 'おしゃれなショルダーバッグ',
            'image' => 'Shoulder_bags.jpg',
            'condition_id' => 2
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'タンブラー',
            'price' => 500,
            'explanation' => '使いやすいタンブラー',
            'image' => 'Tumbler.jpg',
            'condition_id' => 1
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'コーヒーミル',
            'price' => 4000,
            'explanation' => '手動のコーヒーミル',
            'image' => 'Coffee_mill.jpg',
            'condition_id' => 4
        ];
        DB::table('items')->insert($param);

        $param = [
            'name' => 'メイクセット',
            'price' => 2500,
            'explanation' => '便利なメイクアップセット',
            'image' => 'Makeup_set.jpg',
            'condition_id' => 3
        ];
        DB::table('items')->insert($param);
    }
}
