<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BoardRequestTest extends TestCase
{
    /**
     * @test
     * @return void
     */
    public function rules_タグが不正()
    {
        // タグが配列でない
        $params = [
            'tags' => 1
        ];

        $this->from('/boards/create')
            ->post('/boards', $params)
            ->assertStatus(302)
            ->assertRedirect('/boards/create');

        $this->get('/boards/create')
            ->assertSee('タグが不正です');

        // タグが文字列
        $params = [
            'tags' => ['PHP', 'Python']
        ];

        $this->from('/boards/create')
            ->post('/boards', $params)
            ->assertStatus(302)
            ->assertRedirect('/boards/create');

        $this->get('/boards/create')
            ->assertSee('タグが不正です');
    }
}
