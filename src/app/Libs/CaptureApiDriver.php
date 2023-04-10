<?php

namespace App\Libs;

use App\Libs\MycolleUtils;

class CaptureApiDriver
{
    const CREATE_CAPTURE_API_URL = 'http://capture.heartrails.com/200x200';

    public function createCapture($url)
    {
        $response = [];
        $url = self::CREATE_CAPTURE_API_URL . '?' . $url;

        $apiResponse = file_get_contents($url);
        if($apiResponse)
        {
            $response['thumbnail'] = $url;
        }

        return $response;
    }

    public function getCaptureUrl($url)
    {
        return self::CREATE_CAPTURE_API_URL . '?' . $url;
    }


}

