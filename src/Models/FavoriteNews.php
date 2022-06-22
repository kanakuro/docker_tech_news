<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FavoriteNews extends Model
{
    use HasFactory;
    protected $table = 'favorite_news';
    protected $guarded = ['id'];

    public static function registFav($user_id, $fav_title, $fav_url, $fav_img_url)
    {
        $fav = new FavoriteNews;
        $fav -> news_title= $fav_title;
        $fav -> user_id = $user_id; //暫定
        $fav -> news_url = $fav_url;
        $fav -> image_url = $fav_img_url;
        $fav -> created_at = today();
        $fav -> updated_at = today();

        return $fav ->save();
    }

    public static function checkExistingFav($user_id, $fav_title, $fav_url, $fav_img_url)
    {
        $existing_fav = FavoriteNews::where('news_title', $fav_title)
        ->where('user_id', $user_id)
        ->where('news_url', $fav_url)
        ->where('image_url', $fav_img_url)
        ->where('invalid', 0)
        ->first();
        return $existing_fav;
    }

    public static function invalidFav($id)
    {
        FavoriteNews::where('id', $id)->update([
            'invalid' => 1
        ]);
    }
}
