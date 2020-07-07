<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Throwable;

class TopTest extends BaseTestCase
{

    /**
     * トップページ表示
     *
     * @test
     * @return void
     * @throws Throwable
     */
    public function show_トップページ表示()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('掲示板アプリ');
        });
    }
}
