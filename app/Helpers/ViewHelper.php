<?php

namespace App\Helpers;


/**
 * Class ViewHelper
 * @package App\Helpers
 */
class ViewHelper
{
    /**
     * @param string $title
     * @return string
     */
    public static function generateTitle(string $title): string
    {
        $appName = env("APP_NAME", "Laravel");
        return sprintf("%s|%s", $title, $appName);
    }
}