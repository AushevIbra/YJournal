<?php

namespace App;

use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable {
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token', 'email', 'email_verified_at', 'created_at', 'updated_at', 'network', 'role', 'uid', 'ip',
    ];

    public function comment(){
        return $this->hasOne("App\Models\Comment", 'users_id', 'id');
    }

    public function post(){
        return $this->hasMany(Post::class);
    }

    public static function authUser($user, $arrUser = []){
        if($user !== null){
            auth()->loginUsingId($user->id, true);
        } else {
            $newUser = User::create($arrUser);
            auth()->loginUsingId($newUser->id, true);
        }


    }
}
