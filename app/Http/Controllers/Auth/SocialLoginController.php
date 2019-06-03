<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller {
    public function vk(Request $request){
        $responseUser = Socialite::driver('vkontakte')->user();

        $user = User::where('uid', $responseUser->id)->first();
        if($user !== null){
            User::authUser($user);

            return redirect()->route('index');
        }

        $newUser = [
            'name'    => $responseUser->user['first_name'] . ' ' . $responseUser->user['last_name'],
            'avatar'  => $responseUser->user['photo'],
            'country' => $responseUser['country'] ?? '',
            'email'   => $responseUser->email,
            'uid'     => $responseUser->id,
            'role'    => 'user',
            'network' => 'vk',
            'ip'      => $request->ip(),
        ];

        User::authUser($user, $newUser);

        return redirect()->route('index');

    }

    public function facebook() {
        $responseUser = Socialite::driver('vkontakte')->user();
        $user = User::where('email', $responseUser->accessTokenResponseBody['email'])->first();
    }
}
