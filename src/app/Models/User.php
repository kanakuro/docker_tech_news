<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    // /**
    //  * The attributes that should be hidden for serialization.
    //  *
    //  * @var array<int, string>
    //  */
    // protected $hidden = [
    //     'password',
    //     'remember_token',
    // ];

    // /**
    //  * The attributes that should be cast.
    //  *
    //  * @var array<string, string>
    //  */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    protected $table = 'users';
    protected $guarded = ['id'];

    public static function getUser($login_id, $password)
    {
        $result = false;
        $user = User::where('login_id', $login_id)
            ->first();
        if(isset($user)){
            if(Hash::check($password, $user->password)){
                $result = true;
            };
        }
        return $result;
    }
    public static function registUser($login_id, $password)
    {
        $result = false;
        $user = new User;
        $user -> login_id= $login_id;
        $user -> password = Hash::make($password);
        $user -> created_at = today();
        $user -> updated_at = today();
        $user ->save();
        $result = true;
        return $result;
    }


}
