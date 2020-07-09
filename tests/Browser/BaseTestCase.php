<?php

namespace Tests\Browser;

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Tests\DuskTestCase;

class BaseTestCase extends DuskTestCase
{
    /**
     * @return string
     */
    protected function baseUrl()
    {
        return 'http://web';
    }

    /**
     * @return RemoteWebDriver
     */
    protected function driver()
    {
        return RemoteWebDriver::create(
            'http://selenium:4444/wd/hub', DesiredCapabilities::chrome()
        );
    }
}
