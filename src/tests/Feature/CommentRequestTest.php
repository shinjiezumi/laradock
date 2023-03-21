<?php

namespace Tests\Feature;

use App\Board;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentRequestTest extends TestCase
{
    use DatabaseTransactions;

    /**
     *
     */
    public function setUp(): void
    {
        parent::setUp();

        $board = new Board();
        $board->name = 'name';
        $board->title = 'title';
        $board->body = 'body';
        $board->save();
    }

    /**
     * @test
     * @return void
     */
    public function rules_必須パラメータがない()
    {
        $board = Board::first();
        $baseUrl = '/boards/' . $board->id;

        $params = [];
        $this->from($baseUrl)
            ->post($baseUrl . '/comments', $params)
            ->assertStatus(302)
            ->assertRedirect($baseUrl);

        $this->get($baseUrl)
            ->assertSee('名前を入力してください。')
            ->assertSee('コメントを入力してください。');
    }

    /**
     * @test
     * @return void
     */
    public function rules_文字数オーバー()
    {
        $board = Board::first();
        $baseUrl = '/boards/' . $board->id;

        $params = [
            'name' => str_repeat('a', 256),
            'comment' => str_repeat('a', 1025),
        ];
        $this->from($baseUrl)
            ->post($baseUrl . '/comments', $params)
            ->assertStatus(302)
            ->assertRedirect($baseUrl);

        $this->get($baseUrl)
            ->assertSee('名前は255文字以下で入力してください。')
            ->assertSee('コメントは1024文字以下で入力してください。');
    }

}
