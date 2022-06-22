<?php

namespace App\Http\Controllers;

use App\Models\FavoriteNews;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class ApiController extends Controller
{
    public function index()
    {
        $fav_flg = 0;
        try {
            $url = config('newsapi.news_api_url') . "top-headlines?country=jp&category=technology&apiKey=" . config('newsapi.news_api_key');
            $method = "GET";
            // 15記事表示
            $count = 9;
            // API接続
            $client = new Client();
            $response = $client->request($method, $url);
            $results = $response->getBody();
            //jsonを連想配列にする
            $articles = json_decode($results, true);

            $news = [];

            $fav_lists = FavoriteNews::where('user_id', 99)
            ->where('invalid', 0)
            ->get();

            for ($id = 0; $id < $count; $id++) {
                $is_fav = 0;
                $news_name = $articles['articles'][$id]['title'];
                $news_url = $articles['articles'][$id]['url'];
                $news_thumbnail = $articles['articles'][$id]['urlToImage'];
                // お気に入り登録されているか
                foreach ($fav_lists as $index => $fav_list) {
                    if ($fav_list -> news_url == $news_url) {
                        $is_fav = 1;
                        break;
                    }
                }
                array_push($news, [
                    'name' => $news_name,
                    'url' => $news_url,
                    'thumbnail' => $news_thumbnail,
                    'fav' => $is_fav
                ]);
            }
            
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }
        return view('index', [
            'news' => $news,
            'fav_flg' => $fav_flg
        ]);
    }

    public function registFav(Request $request)
    {
        $fav_url = $request->url;
        $fav_title = $request->title;
        $fav_img_url =  $request->img_url;
        $user_id = 99;
        FavoriteNews::registFav($user_id, $fav_title, $fav_url, $fav_img_url);
        // slackに通知
        \Slack::send($fav_url);
        return;
    }

    public function getFav(Request $request)
    {
        $user_id = 99;
        $result = FavoriteNews::where('user_id', $user_id)
        ->where('invalid', 0)
        ->get();
        return $result;
    }

    public function invalidFav(Request $request)
    {
        $fav_url = $request->url;
        $fav_title = $request->title;
        $fav_img_url = $request->img_url;
        $user_id = $request->user_id;
        $existing_fav = FavoriteNews::checkExistingFav($user_id, $fav_title, $fav_url, $fav_img_url);
        if (isset($existing_fav)) {
            FavoriteNews::invalidFav($existing_fav -> id);
            return;
        }
    }
}
