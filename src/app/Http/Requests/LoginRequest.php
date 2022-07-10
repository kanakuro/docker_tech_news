<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if($this->path() == 'confirm_or_regist_user'){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        if($this->create_user_flg == '1'){
            return [
                'login_id' => 'required|unique:users,login_id|alpha-num',
                'password' => 'required|confirmed',
                'email' => 'nullable|email'
            ];
        }else{
            return [
                'login_id' => 'required',
                'password' => 'required'
            ];
        }
    }

    public function messages(){
        return [
            'login_id.required' => 'ログインIDは必ず入力してください。',
            'login_id.unique' => '入力されたログインIDは既に存在しています。入力し直してください。',
            'login_id.alpha-num' => 'ログインIDはアルファベットと数字で入力してください。',
            'password.required' => 'パスワードは必ず入力してください。',
            'password.confirmed' => '入力されたパスワードが一致しません。',
            'email.email' => 'メールアドレスの入力が必要です。'
        ];
    }
}
