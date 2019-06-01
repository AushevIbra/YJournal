<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Redirect;
use GuzzleHttp\Client;

class UloginController extends Controller
{
    public function login(Request $request)
    {

        // Get information about user.
        $client = new Client();
        $data = $client->get('http://ulogin.ru/token.php?token=' . $_POST['token'] . '&host=' . $_SERVER['HTTP_HOST'])->getBody()->getContents();
        $user = json_decode($data, TRUE);


        $network = $user['network'];
                // Find user in DB.
        $userData = User::where('email', $user['email'])->first();

        // Check exist user.
        if (isset($userData->id)) {
            Auth::loginUsingId($userData->id, TRUE);
            return Redirect::back();
        }
        // Make registration new user.
        else {
            //var_dump($network);die;

            // Create new user in DB.
            $newUser = User::create([
                'name' => $user['first_name'] . ' ' . $user['last_name'],
                'avatar' => $user['photo_big'],
                'country' => $user['country'] ?? '',
                'email' => $user['email'],
                'uid' => $user['uid'],
                'role' => 'user',
                'network' => $network,
                'ip' => $request->ip()
            ]);

            // Make login user.
            Auth::loginUsingId($newUser->id, TRUE);

            \Session::flash('flash_message', trans('interface.ActivatedSuccess'));

            return redirect('/');
        }
    }
}
