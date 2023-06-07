<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register_view(){
        return view("auth.register");
    }

    public function register(Request $request){

        $validation = $request->validate([
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required', 'unique:users'],
            'password' => ['required'],
        ]);

        $user = User::query()->create([
            'first_name' => $validation['first_name'],
            'last_name' => $validation['last_name'],
            'email' => $validation['email'],
            'password' => Hash::make($validation['password']),
            'avatar' => '/imgs/avatars/' . random_int(1, 7) . '.jpg',
        ]);

        session()->put('user', $user);
        return redirect("/books");
    }


    public function login_view(){
        return view("auth.login");
    }

    public function login(Request $request){
        $user = User::query()
            ->where('email', $request->input('email'))
            ->first();

        if(!Hash::check($request->input('password'), $user->password)){
            return redirect("/login");
        }

        session()->put('user', $user);
        return redirect("/books");
    }




    public function logout(){
        session()->forget('user');
        return redirect("/");
    }
}
