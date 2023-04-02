<?php

use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'PHP',
            'Python',
            'Ruby',
            'Go',
            'Java',
            'Rust',
            'Javascript',
            'Typescript',
        ];
        foreach ($tags as $tag) {
            DB::table('tags')->insert(['name' => $tag]);
        }
    }
}
