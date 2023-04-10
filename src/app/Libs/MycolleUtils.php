<?php
namespace App\Libs;

class MycolleUtils
{

    public static function createDummyThumbnail($width=150, $height=150)
    {
        return "https://placehold.jp/{$width}x{$height}.png?text=NO%20IMAGE";
    }

    public static function escapeArray($array){
        $result = [];
        foreach ($array as $key => $value)
        {
            $value = self::convertCharCode($value);
            $result[$key] = e($value);
        }

        return $result;
    }

    public static function convertCharCode($str, $convertCharCd='UTF-8')
    {
        $detectCharCd = mb_detect_encoding($str);
        if(!$detectCharCd)
        {
            return '';
        }
        return mb_convert_encoding($str, $convertCharCd, $detectCharCd);
    }

    public static function convertProtocol($url)
    {
        $urlInfo = parse_url($url);

        if(isset($urlInfo['scheme']) && $urlInfo['scheme'] === 'http')
        {
            $url = str_replace('http', 'https', $url);
        }
        return $url;
    }
}