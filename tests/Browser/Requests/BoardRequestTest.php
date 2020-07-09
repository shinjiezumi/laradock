<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Throwable;

class BoardRequestTest extends BaseTestCase
{
    /**
     * @return void
     * @throws Throwable
     */
    public function rules_必須パラメータが存在しない()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/boards/create')
                ->press('保存')
                ->assertSee('名前を入力してください。')
                ->assertSee('タイトルを入力してください。')
                ->assertSee('本文を入力してください。');
        });
    }

    /**
     * @return void
     * @throws Throwable
     */
    public function rules_名前、タイトル、本文が文字数オーバー()
    {
        $nameTitleMax = str_repeat('a', 256);
        $bodyMax = str_repeat('a', 1025);
        $this->browse(function (Browser $browser) use ($nameTitleMax, $bodyMax) {
            $browser
                ->visit('/boards/create')
                ->type('name', $nameTitleMax)
                ->type('title', $nameTitleMax)
                ->type('body', $bodyMax)
                ->press('保存')
                ->assertSee('名前は255文字以下で入力してください。')
                ->assertSee('タイトルは255文字以下で入力してください。')
                ->assertSee('本文は1024文字以下で入力してください。');
        });
    }
}
