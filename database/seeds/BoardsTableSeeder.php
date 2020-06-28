<?php

use Illuminate\Database\Seeder;

class BoardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 50; $i++) {
            DB::table('boards')->insert([
                'author' => 'ユーザー' . ($i + 1),
                'title' => 'タイトル' . ($i + 1),
                'body' => '本文' . ($i + 1),
            ]);
        }
    }
}
