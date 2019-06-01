<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    /**
     * @var User
     */
    private $user;

    public function __construct(User $user){

        $this->user = $user;
    }

    public function index($id){
        $user = $this->user::with('post')->find($id);

        return view('user.index', compact('user'));
    }

    public function setting(Request $request){

        $user = auth()->user();
        if($request->post()){
            $request->validate([
                'name' => 'required|max:25',
            ]);
            $avatar = $request->file('avatar')? "/storage/" . $request->file('avatar')->store('avatars', 'public'): $user->avatar;
            $user->update([
                'name'   => $request->post('name'),
                //'email' => $request->post('email'),
                'avatar' => $avatar,
            ]);
        }

        return view('user.edit', compact('user'));
    }
}
