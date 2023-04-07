<?php

namespace App\Libs;

use Illuminate\Support\Facades\Log;
use Exception;

class YoutubeApiDriver
{
    const YOUTUBE_WATCH_URL = 'https://www.youtube.com/watch?v=%s';
    private $developerKey = null;

    public function __construct()
    {
        $this->developerKey = env('YOUTUBE_DEVELOPER_KEY', 'AIzaSyC66W58ey5maCMNPHai6ktQZUeflx11CuI');
    }

    public function searchYoutube($searchKeywords)
    {
        /*
           * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
           * Google Developers Console <https://console.developers.google.com/>
           * Please ensure that you have enabled the YouTube Data API for your project.
           */
        $client = new \Google_Client();
        $client->setDeveloperKey($this->developerKey);

        // Define an object that will be used to make all API requests.
        $youtube = new \Google_Service_YouTube($client);
        $response = [];
        try {
            // Call the search.list method to retrieve results matching the specified
            // query term.
            $searchResponse = $youtube->search->listSearch('id,snippet', array(
                'q' => urlencode($searchKeywords),
                'maxResults' => 50,
                'type' => 'video'
            ));

            $videos = [];
            $channels = [];
            $playlists = [];

            // Add each result to the appropriate list, and then display the lists of
            // matching videos, channels, and playlists.
            foreach ($searchResponse['items'] as $searchResult) {
                switch ($searchResult['id']['kind']) {
                    case 'youtube#video':
//                        $videos[] = sprintf('%s (%s)', $searchResult['snippet']['title'], $searchResult['id']['videoId']);
                        $video['content_id'] = $searchResult['id']['videoId'];
                        $video['title'] = $searchResult['snippet']['title'];
                        $video['description'] = $searchResult['snippet']['description'];
                        $video['thumbnail'] = $searchResult['snippet']['thumbnails']['default']['url'];
                        $video['collection_type'] = MycolleConstants::COLLECTION_TYPE_YOUTUBE;
                        $video['content_url'] = sprintf(self::YOUTUBE_WATCH_URL, $searchResult['id']['videoId']);
                        break;
                    case 'youtube#channel':
                        $channels[] = sprintf('%s (%s)', $searchResult['snippet']['title'], $searchResult['id']['channelId']);
                        break;
                    case 'youtube#playlist':
                        $playlists[] = sprintf('%s (%s)', $searchResult['snippet']['title'], $searchResult['id']['playlistId']);
                        break;
                    default:
                        break;
                }
                $response[] = $video;
            }
        } catch (Google_Service_Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        } catch (Google_Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        } catch (Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

    public function getVideo($videoId)
    {

        /*
           * Set $DEVELOPER_KEY to the "API key" value from the "Access" tab of the
           * Google Developers Console <https://console.developers.google.com/>
           * Please ensure that you have enabled the YouTube Data API for your project.
           */
        $client = new \Google_Client();
        $client->setDeveloperKey($this->developerKey);

        // Define an object that will be used to make all API requests.
        $youtube = new \Google_Service_YouTube($client);
        $response = [];
        try {
            // Call the search.list method to retrieve results matching the specified
            // query term.
            $searchResponse = $youtube->videos->listVideos('id, snippet, player', array(
                'id' => urlencode($videoId),
                'maxResults' => 50
            ));


            $response = $searchResponse['items'][0]['modelData'];
            $response['id'] =$searchResponse['items'][0]['id'];
            $response['kind'] =$searchResponse['items'][0]['kind'];
            $response['etag'] =$searchResponse['items'][0]['etag'];

        } catch (Google_Service_Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        } catch (Google_Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        } catch (Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        }


return $response;
    }
}

