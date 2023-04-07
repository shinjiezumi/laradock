<?php

namespace App\Libs;

use DateTime;
//use Exception;
use Illuminate\Support\Facades\Log;

class SlideshareApiDriver
{
    const SEARCH_SLIDE_API = "https://www.slideshare.net/api/2/search_slideshows?q=%s&api_key=%s&ts=%s&hash=%s&lang=ja&sort=mostviewed";
    const GET_SLIDE_API = "https://www.slideshare.net/api/2/get_slideshow?slideshow_id=%s&api_key=%s&ts=%s&hash=%s&lang=ja";

    private $apiKey = null;
    private $secret = null;

    public function __construct()
    {
        $this->apiKey = env('SLIDE_SHARE_API_KEY', 'mQQmjpp8');
        $this->secret = env('SLIDE_SHARE_API_SECRET', 'gt3qmWkA');
    }

    public function searchSlide($searchKeywords)
    {
        try{
            $ts = (new DateTime())->getTimestamp();
            $hash = sha1($this->secret.$ts);
            $q = urlencode($searchKeywords);
            $url = sprintf(self::SEARCH_SLIDE_API, $q, $this->apiKey, $ts, $hash);
            $apiResponse = file_get_contents($url);

            $apiResponse = simplexml_load_string($apiResponse);
            $apiResponse = json_decode(json_encode($apiResponse), true);
            $slideList = $apiResponse['Slideshow'];

            $needInfoList = array('Title', 'Description', 'ThumbnailURL', 'Embed', 'ID', 'URL');
            $responseMapList = array('Title' => 'title', 'Description' => 'description', 'ThumbnailURL' => 'thumbnail', 'Embed' => 'content', 'ID' => 'content_id', 'URL' => 'content_url');
            foreach ($slideList as $slide){
                $data = [];
                foreach ($slide as $key => $value){
                    if(in_array($key, $needInfoList)){
                        $data[$responseMapList[$key]] = $value;
                    }
                }
                $data['collection_type'] = MycolleConstants::COLLECTION_TYPE_SLIDE_SHARE;
                $response[] = $data;
            }
        }catch(Exception $e){
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

    public function getSlide($slideShowId)
    {
        try{
            $ts = (new DateTime())->getTimestamp();
            $hash = sha1($this->secret.$ts);
            $url = sprintf(self::GET_SLIDE_API, $slideShowId, $this->apiKey, $ts, $hash);
            $apiResponse = file_get_contents($url);

            $apiResponse = simplexml_load_string($apiResponse);
            $response = json_decode(json_encode($apiResponse), true);
        }catch (Exception $e){
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }
}

