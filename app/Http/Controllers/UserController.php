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
        $request->validate([
            'email'    => 'required|email|exists:users,email',
            'password' => 'required',
        ]);

        $user_data = array(
            'email' => $request->get('email'),
            'password' => $request->get('password')
        );

        if(Auth::attempt($user_data)){
            return redirect('/');
        }
        else{
            return back()->with('error', 'Login failed. Please check your credentials.')->withErrors(['password' => 'Invalid password']);
        }
    }

    public function Logout(){
        Auth::logout();
        return redirect('/');
    }

    public function Register(Request $request){
        $validator = Validator::make($request->all(), [
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed', 
        ]);
    
        if ($validator->fails()) {
            return redirect('/register')->withErrors($validator)->withInput();
        }
    
        User::create([
            'name'     => $request->input('name'),
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
        ]);
    
        return redirect('/login')->with('success', 'Registration successful. Please login.');
    }
}