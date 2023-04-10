<?php

namespace App\Libs;

use App\Libs\MycolleUtils;
//use Exception;

class FeedlyApiDriver
{
    const API_BASE_URL = 'https://cloud.feedly.com/v3';
    const API_URL_GET_FEED = self::API_BASE_URL . '/feeds/' . self::API_ALIAS_FEED_ID;
    const API_URL_SEARCH_FEEDS = self::API_BASE_URL . '/search/feeds';
    const API_URL_GET_STREAMS = self::API_BASE_URL . '/streams/' . self::API_ALIAS_FEED_ID . '/contents?count=5';

    const API_ALIAS_FEED_ID = '#FEED_ID#';
    const API_ALIAS_ENTRY_ID = '#ENTRY_ID#';

    private $apiToken = null;

    public function __construct()
    {
        $this->apiToken = env('FEEDLY_API_TOKEN', 'dummy');
    }

    public function searchFeeds($keywords)
    {
        try{
            $response = [];
            $url = self::API_URL_SEARCH_FEEDS . '?query=' . urlencode($keywords) . '&count=20&locale=ja';

            $apiResponse = file_get_contents($url);
            if ($apiResponse) {
                $response = $this->createSearchFeedResponse($apiResponse);
            }
        }catch (Exception $e){
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

    public function getFeed($feedId)
    {
        try{
            $response = [];
            $url = str_replace(self::API_ALIAS_FEED_ID, urlencode($feedId), self::API_URL_GET_FEED);

            $apiResponse = file_get_contents($url);
            if ($apiResponse) {
                $response = json_decode($apiResponse, true);
            }
        }catch (Exception $e){
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

    public function getStreams($feedId)
    {
        try{
            $response = [];
            $url = str_replace(self::API_ALIAS_FEED_ID, urlencode($feedId), self::API_URL_GET_STREAMS);

            $apiResponse = file_get_contents($url);
            if ($apiResponse) {
                $response = json_decode($apiResponse, true);
            }
        }catch (Exception $e){
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

    private function getAuthHeader()
    {
        return stream_context_create(
            array("http" => array("header" => "Authorization: OAuth " . $this->apiToken))
        );
    }

    public function createSearchFeedResponse($apiResponse)
    {
        $response = [];
        $apiResponse = json_decode($apiResponse, true);

        foreach($apiResponse['results'] as $result){
            if(!$this->validate(self::API_URL_SEARCH_FEEDS, $result))
            {
                continue;
            }
            $data['content_id'] = $result['feedId'];
            $data['title'] = MycolleUtils::convertCharCode($result['title']);
            $data['description'] = isset($result['description']) ? MycolleUtils::convertCharCode($result['description']) : '-';
            $data['thumbnail'] = isset($result['visualUrl']) ? $result['visualUrl'] : MycolleUtils::createDummyThumbnail();
            $data['site_type'] = MycolleConstants::SITE_TYPE_FEEDLY;
            $data['site_url'] = $result['website'];
            $data['tags'] = isset($result['deliciousTags']) ? MycolleUtils::escapeArray($result['deliciousTags']) : [];
            $data['followers'] = $result['subscribers'];

            $response[] = $data;
        }

        return $response;
    }

    public function validate($type, $data)
    {
        switch($type)
        {
            case self::API_URL_SEARCH_FEEDS:
                if(!isset($data['feedId']) || !isset($data['title']) || !isset($data['website']))
                {
                    return false;
                }
                break;
            default:
                break;
        }

        return true;
    }
}

