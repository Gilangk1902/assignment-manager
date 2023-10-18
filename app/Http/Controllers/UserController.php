<?php

namespace App\Http\Controllers;

use App\Models\Board;
use App\Models\User;
use Database\Factories\UserFactory;
use Hash;
use Illuminate\Http\Request;

use Validator;
use Auth;

class UserController extends Controller
{
    public function ViewLoginPage(){
        return view('/login');
    }

    public function ViewRegisterPage(){
        return view('/register');
    }

    public function Login(Request $request){
        $this->validate(
            $request,
            [
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/');
        }
        else{
            return back()->with('error', 'login failed');
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/');
    }

    public function Register(Request $request){
        $this->validate(
            $request,
            [
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'required'
            ]
        );

        User::create(
            [
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password'))
            ]
        );

        return redirect('/login');
    }
}