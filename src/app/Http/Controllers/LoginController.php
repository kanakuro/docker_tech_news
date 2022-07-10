<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function getLogin($create_user=null, $errmessage=null)
    {
        return view('login', [
            'create_user' => $create_user,
            'errmessage' => $errmessage
        ]);
    }

    public function confirmOrRegistUser(LoginRequest $request){
        $login_id = $request->login_id;
        $password = $request->password;
        $create_user = $request->create_user_flg;
        $result = null;
        if(!isset($create_user)){
            $create_user = 0;
        }

        // ログインの場合
        if ($request->has('login')) {
            if(Auth::attempt(['login_id'=>$login_id, 'password'=>$password])){
                // ログイン成功
                return redirect()->action([ApiController::class, 'getIndex']);
            }else{
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
            $result = User::registUser($login_id, $password);
            if($result == true){
                $message = 'アカウント作成しました';
                $param = [
                    'create_user' => $create_user,
                    'message' => $message
                ];
                return redirect()->action([ApiController::class, 'getIndex']);
            }else{
                // エラー
                $errmessage = 'アカウント作成できませんでした';
                $param = [
                    'create_user' => $create_user,
                    'errmessage' => $errmessage
                ];
                return redirect()->action([LoginController::class, 'getLogin']  , $param);
            }

        }else{
            // エラー
            $errmessage = '不正な操作が行われました。';
            $param = [
                'create_user' => $create_user,
                'errmessage' => $errmessage
            ];
            return redirect()->action([LoginController::class, 'getLogin'], $param);
        }
    }

}
