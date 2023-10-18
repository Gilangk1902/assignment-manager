<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

use Validator;
use Auth;

class LoginController extends Controller
{
    public function index(){
        return view('/login');
    }

    public function CheckLogin(Request $request){
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
}