<?php

namespace App\Libs;

use DateTime;
use DOMDocument;
use Exception;
use App\Libs\vender\simple_html_dom;

class HtmlDriver
{
    public function searchHtml($url)
    {
        $response = [];
        try {
            $captureApiDriver = new CaptureApiDriver();
            $apiResponse = $captureApiDriver->createCapture($url);

            $html = new simple_html_dom($url);

            $title = !is_null($html->find('title', 0)) ? $html->find('title', 0)->plaintext : '';
            $description = '';
            if(!is_null($html->find("meta[name='description']", 0))){
                $description = $html->find("meta[name='description']", 0)->getAttribute('content');
            }else if(!is_null($html->find("meta[name='Description']", 0))){
                $description = $html->find("meta[name='Description']", 0)->getAttribute('content');
            }

            $response['title'] = !is_null($title) ? $title : 'No Title';
            $response['description'] = !is_null($description) ? $description : 'No Description';
            $response['thumbnail'] = $apiResponse['thumbnail'];
            $response['content'] = $url;
            $response['content_id'] = $url;
            $response['content_url'] = $url;
            $response['collection_type'] = MycolleConstants::COLLECTION_TYPE_HTML;

        } catch (Exception $e) {
            $response['errorMsg'] = $e->getMessage();
        }

        return $response;
    }

}

