<?php

namespace Tests\Unit\Helpers;

use App\Helpers\ViewHelper;
use Tests\TestCase;

/**
 * Class ViewHelperTest
 * @package Tests\Helpers
 */
class ViewHelperTest extends TestCase
{
    public function testGenerateTitle()
    {
        $title = ViewHelper::generateTitle('hogehoge');
        var_export($title, true);
        $this->assertSame('hogehoge｜Laradock', $title);
    }
}
