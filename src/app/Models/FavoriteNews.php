<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\ModelNotFoundException;

class FavoriteNews extends Model
{
    use HasFactory;
    protected $table = 'favorite_news';
    protected $guarded = ['id'];

    public static function getFav($user_id)
    {
        try {
            $result = FavoriteNews::where('user_id', $user_id)
                ->where('invalid', 0)
                ->get()
                ->toArray();
            return $result;
        }catch (ModelNotFoundException $e) {
            // データが見つからなかっただけならロギング不要
            throw $e;
        }catch(\Throwable $e) {
            DB::rollback();
            \Log::error($e);
            throw $e;
        }
    }

    public static function registFav($user_id, $fav_title, $fav_url, $fav_img_url)
    {
        try {
            DB::beginTransaction();
            $fav = new FavoriteNews;
            $fav -> news_title= $fav_title;
            $fav -> user_id = $user_id; //暫定
            $fav -> news_url = $fav_url;
            $fav -> image_url = $fav_img_url;
            $fav -> created_at = today();
            $fav -> updated_at = today();
            $fav ->saveOrFail();
            DB::commit();
            return;
        }catch(\Throwable $e) {
            DB::rollback();
            \Log::error($e);
            throw $e;
        }
    }

    public static function checkExistingFav($user_id, $fav_title, $fav_url, $fav_img_url)
    {
        try {
            $existing_fav = FavoriteNews::where('news_title', $fav_title)
                ->where('user_id', $user_id)
                ->where('news_url', $fav_url)
                ->where('image_url', $fav_img_url)
                ->where('invalid', 0)
                ->first();
            return $existing_fav;
        }catch (ModelNotFoundException $e) {
            // データが見つからなかっただけならロギング不要
            throw $e;
        }catch(\Throwable $e) {
            \Log::error($e);
            throw $e;
        }
    }

    public static function invalidFav($id)
    {
        try {
            // トランザクションの開始
            DB::beginTransaction();
            FavoriteNews::where('id', $id)->update([
                'invalid' => 1
                ]);
            DB::commit();
            return;
        }catch (ModelNotFoundException $e) {
            throw $e;
        } catch (\Throwable $e) {
            DB::rollback();
            \Log::error($e);
            throw $e;
        }
    }
}
