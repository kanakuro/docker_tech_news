<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class LoginController extends Controller
{
    public function getLogin($create_user, $errmessage=null)
    {
        try {
            if(!isset($create_user)){
                $create_user = false;
            }
        } catch (RequestException $e) {
            echo Psr7\Message::toString($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\Message::toString($e->getResponse());
            }
        }
        return view('login', [
            'create_user' => $create_user,
            'errmessage' => $errmessage
            // 'fav_flg'x => $fav_flg
        ]);
    }

    public function confirmOrRegistUser(Request $request){
        $login_id = $request->login_id;
        $password = $request->password;
        $create_user = $request->create_user_flg;
        if(!isset($create_user)){
            $create_user = 0;
        }
        // ログインの場合
        if ($request->has('login')) {
            $user = User::getUser($login_id, $password);
            $param =[];
            if (isset($user)) {
                // ログイン成功
                return redirect()->action([ApiController::class, 'getIndex']);
            } else {
                // ログイン失敗
                $errmessage = 'ユーザIDもしくはパスワードが間違っています';
                $param = [
                    'create_user' => $create_user,
                    'errmessage' => $errmessage
                ];
                return redirect()->action([LoginController::class, 'getLogin'], $param);
            }
        // アカウント作成の場合
        }elseif($request->has('create_user')){
            // アカウント作成成功
            User::registUser($login_id, $password);
            $message = 'アカウント作成しました';
            $param = [
                'create_user' => $create_user,
                'message' => $message
            ];
            return redirect()->action([ApiController::class, 'getIndex']);

        }else{
            // エラー
            $errmessage = '不正な操作が行われました。';
            $param = [
                'create_user' => $create_user,
                'errmessage' => $errmessage
            ];
            return redirect()->action([LoginController::class, 'getLogin'], $param);
        }
        // return view('confirm-or-regist-user', $param);

    }

}
