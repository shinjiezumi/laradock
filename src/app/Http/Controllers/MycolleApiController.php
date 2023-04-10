<?php

namespace App\Http\Controllers;

use App\Libs\FeedlyApiDriver;
use App\Libs\HtmlDriver;
use App\Libs\MycolleConstants;
use App\Libs\MycolleUtils;
use App\Libs\SlideshareApiDriver;
use App\Libs\YoutubeApiDriver;
use App\MyCollection;
use App\MySite;
use App\Mysites;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class MycolleApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getMycolle(Request $request, $mycolleId = null)
    {
        $userId = Auth::user()->id;
        $response = [];
        if (!is_null($mycolleId)) {
            $myCollections[] = MyCollection::findOrFail($mycolleId)->get();
        } else {
            $myCollections = MyCollection::where('user_id', $userId)->get();
        }

        foreach ($myCollections as $myCollection) {
            $collectionDetail = json_decode($myCollection->collection_detail, true);

            $data['mycolle_id'] = $myCollection->id;
            $data['collection_type'] = $myCollection->collection_type_id;

            switch ($myCollection->collection_type_id) {
                case MycolleConstants::COLLECTION_TYPE_SLIDE_SHARE:
                    $data['title'] = isset($collectionDetail['Title']) ? $collectionDetail['Title'] : '';
                    $data['description'] = !empty($collectionDetail['Description']) ? $collectionDetail['Description'] : '';
                    $data['thumbnail'] = isset($collectionDetail['ThumbnailURL']) ? $collectionDetail['ThumbnailURL'] : MycolleUtils::createDummyThumbnail();
                    $data['content'] = $collectionDetail['Embed'];
                    $data['content_url'] = $collectionDetail['URL'];
                    break;

                case MycolleConstants::COLLECTION_TYPE_YOUTUBE:
                    $data['title'] = $collectionDetail['snippet']['title'];
                    $data['description'] = $collectionDetail['snippet']['description'];
                    $data['thumbnail'] = $collectionDetail['snippet']['thumbnails']['default']['url'];
                    $data['content'] = $collectionDetail['player']['embedHtml'];
                    $data['content_url'] = isset($collectionDetail['url']) ? $collectionDetail['url'] : '';

                    break;
                case MycolleConstants::COLLECTION_TYPE_HTML:
                    $data['title'] = isset($collectionDetail['title']) ? $collectionDetail['title'] : '';
                    $data['description'] = isset($collectionDetail['description']) ? $collectionDetail['description'] : '';
                    $data['thumbnail'] = $collectionDetail['thumbnail'];
                    $data['content'] = isset($collectionDetail['url']) ? $collectionDetail['url'] : '';
                    $data['content_url'] = isset($collectionDetail['url']) ? $collectionDetail['url'] : '';

                    break;
                default:
                    break;
            }

            $response[] = $data;
        }

        return response()->json($this->createResponse($response));

    }

    public function editMycolle(Request $request, $mycolleId)
    {
        $userId = Auth::user()->id;
        $collectionType = $request->get('collection_type', null);
        $contentId = $request->get('content_id', null);
        $deleteFlag = $request->get('delete_flag', false);

        $response = [];
        if ($deleteFlag == "false") {
            switch ($collectionType) {
                case MycolleConstants::COLLECTION_TYPE_SLIDE_SHARE:
                    $apiDriver = new SlideshareApiDriver();
                    $apiResponse = $apiDriver->getSlide($contentId);
                    if (isset($apiResponse['errorMsg'])) {
                        return response()->json($this->createResponse([], '', true));
                    }

                    break;
                case MycolleConstants::COLLECTION_TYPE_YOUTUBE:
                    $apiDriver = new YoutubeApiDriver();
                    $apiResponse = $apiDriver->getVideo($contentId);
                    if (isset($apiResponse['errorMsg'])) {
                        return response()->json($this->createResponse([], '', true));
                    }
                    $apiResponse['url'] = sprintf(YoutubeApiDriver::YOUTUBE_WATCH_URL, $apiResponse['id']);
                    break;
                case MycolleConstants::COLLECTION_TYPE_HTML:
                    $apiDriver = new HtmlDriver();
                    $tmp = $apiDriver->searchHtml($contentId);
                    if (isset($tmp['errorMsg'])) {
                        return response()->json($this->createResponse([], '', true));
                    }

                    $apiResponse['url'] = $contentId;
                    $apiResponse['title'] = $tmp['title'];
                    $apiResponse['thumbnail'] = $tmp['thumbnail'];
                    $apiResponse['description'] = $tmp['description'];
                    break;
                default:
                    break;
            }

            $myCollection = new MyCollection();
            $myCollection->user_id = $userId;
            $myCollection->collection_type_id = $collectionType;
            $myCollection->collection_detail = json_encode($apiResponse);
            $myCollection->save();


            $response['mycolle_id'] = $myCollection->id;
        } else {
            MyCollection::findOrFail($mycolleId)->delete();
        }

        return response()->json($this->createResponse($response));
    }

    public function searchMycolle(Request $request, $collectionType, $searchKeywords)
    {
        $userId = Auth::user()->id;
        switch ($collectionType) {
            case MycolleConstants::COLLECTION_TYPE_FEEDLY :
                $apiDriver = new FeedlyApiDriver();
                $response = $apiDriver->searchContents($searchKeywords);
                break;
            case MycolleConstants::COLLECTION_TYPE_SLIDE_SHARE :
                $apiDriver = new SlideshareApiDriver();
                $response = $apiDriver->searchSlide($searchKeywords);
                break;
            case MycolleConstants::COLLECTION_TYPE_YOUTUBE :
                $apiDriver = new YoutubeApiDriver();
                $response = $apiDriver->searchYoutube($searchKeywords);
                break;
            case MycolleConstants::COLLECTION_TYPE_HTML :
                $apiDriver = new HtmlDriver();
                //URLエンコードが2回掛かっているため処理する
                $url = urldecode(urldecode($searchKeywords));
                $response = $apiDriver->searchHtml($url);
                break;
            default:
                break;
        }

        return response()->json($this->createResponse($response));
    }

    public function getMysites(Request $request, $mysiteId = null)
    {
        $userId = Auth::user()->id;
        $response = [];
        if (!is_null($mysiteId)) {
            $mySites[] = MySite::findOrFail($mysiteId)->get();
        } else {
            $mySites = MySite::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        }

        foreach ($mySites as $mySite) {
            $siteDetail = json_decode($mySite->site_detail, true);

            $data['mysite_id'] = $mySite->id;
            $data['site_type'] = $mySite->site_type_id;
            $data['title'] = $siteDetail['title'];
            $data['description'] = isset($siteDetail['description']) ? $siteDetail['description'] : '-';
            $data['thumbnail'] = isset($siteDetail['visualUrl']) ? $siteDetail['visualUrl'] : MycolleUtils::createDummyThumbnail();
            $data['site_url'] = $siteDetail['website'];
            $data['tags'] = isset($siteDetail['deliciousTags']) ? $siteDetail['deliciousTags'] : [];
            $data['followers'] = $siteDetail['subscribers'];

            $response[] = $data;
        }

        return response()->json($this->createResponse($response));

    }

    public function editMysites(Request $request, $mysiteId)
    {
        $userId = Auth::user()->id;
        $siteTypeId = $request->get('site_type', null);
        $contentId = $request->get('content_id', null);
        $deleteFlag = $request->get('delete_flag', false);

        $response = [];
        if ($deleteFlag == "false") {
            $apiDriver = new FeedlyApiDriver();
            $siteDetail = $apiDriver->getFeed($contentId);

            $mySite = new MySite();
            $mySite->user_id = $userId;
            $mySite->site_type_id = $siteTypeId;
            $mySite->site_detail = json_encode($siteDetail);
            $mySite->save();

            $response['mysite_id'] = $mySite->id;
        } else {
            MySite::findOrFail($mysiteId)->delete();
        }

        return response()->json($this->createResponse($response));
    }

    public function searchMysites(Request $request, $siteType, $searchKeywords)
    {
        switch ($siteType) {
            case MycolleConstants::SITE_TYPE_FEEDLY :
                $apiDriver = new FeedlyApiDriver();
                $response = $apiDriver->searchFeeds($searchKeywords);
                break;
            default:
                break;
        }

        return response()->json($this->createResponse($response));
    }

    public function getMysiteIds(Request $request)
    {
        $userId = Auth::user()->id;
        $response = [];
        $mySites = MySite::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        foreach ($mySites as $mySite) {
            $response[] = $mySite->id;
        }

        return response()->json($this->createResponse($response));
    }


    public function getMysiteContents(Request $request, $mysiteId = null)
    {
        $userId = Auth::user()->id;
        $response = [];
        if (!is_null($mysiteId)) {
            $mySites = MySite::where('user_id', $userId)->where('id', $mysiteId)->get();
        } else {
            $mySites = MySite::where('user_id', $userId)->orderBy('created_at', 'asc')->get();
        }

        foreach ($mySites as $mySite) {
            $siteDetail = json_decode($mySite->site_detail, true);

            switch ($mySite->site_type_id) {
                case MycolleConstants::SITE_TYPE_FEEDLY:
                    $feedId = $siteDetail['id'];

                    $apiDriver = new FeedlyApiDriver();
                    $contents = $apiDriver->getStreams($feedId);
                    $cnt = 0;
                    $items = [];
                    foreach ($contents['items'] as $content) {
                        $items[$cnt]["item_id"] = $content['id'];
                        $items[$cnt]["title"] = isset($content['title']) ? $content['title'] : '';
                        $items[$cnt]["keywords"] = MycolleUtils::escapeArray(isset($content['keywords']) ? $content['keywords'] : []);
                        //TODO direction(ltr, rtl)要確認。HTMLタグのためescapeしていない
                        $items[$cnt]["summary"] = @isset($content['summary']['content']) ? strip_tags($content['summary']['content']) : '';
                        $items[$cnt]["thumbnail"] = (isset($content['visual']['url']) && $content['visual']['url'] !== 'none') ? $content['visual']['url'] : MycolleUtils::createDummyThumbnail();
                        $items[$cnt]["url"] = $content['alternate'][0]['href'];
                        $items[$cnt]["date"] = (new DateTime())->setTimeStamp($content['published'])->format('Y-m-d H:i:s');
                        $cnt++;
                    }

                    $mySiteContents['mysite_id'] = $mySite->id;
                    $mySiteContents['site_title'] = $siteDetail['title'];
                    $mySiteContents['items'] = $items;
                    break;

                default:
                    break;
            }
            $response[] = $mySiteContents;
        }
        return response()->json($this->createResponse($response));
    }

    private function createResponse($details = [], $msg = '', $errFlag = false)
    {
        $response = array(
            'msg' => $msg,
            'error_flag' => $errFlag,
            'details' => $details
        );

        return $response;
    }

}
