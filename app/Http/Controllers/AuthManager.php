<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use MongoDB\Driver\Session;

class AuthManager extends Controller
{
    function register()
    {
        return view('registration');
    }
    function login()
    {
        return view('login');
    }
    function test()
    {
        return view('info');
    }

    // built in class hn 'request'
    function registrationPost(Request $request){

        $request->validate([
            // 'name' in the html form is here the key
            'name'=>'required',
            // users is the name of the table, we also leave the users
            'email'=>'required|email|unique:users', // means the format should be the email and it should be unique
            'password'=>'required|min:8', // means mimimum 8 characters must be there in the password
        ]);
        // Brings all the data that is submitted in the form
      $data=$request->all();
      // array in which name, email, password is stored
      $data['password']=$request->password;
      $data['email']=$request->email;
      $data['name']=$request->name;

      $user = User::create($data);

      if(!$user){
          // redirects on the specified path
          return redirect(route('registration'))->with('error', 'Registration Failed');

      }
        return redirect(route('login'))->with('success', 'Registration Successful');
    }
    function loginPost(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);
        $credentials = $request->only('email', 'password');
        // matching the password and email with the database
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return redirect()->route('welcome');
        }
        return redirect(route('login'))->with('error', 'Login Failed');
    }
    function logout(){
        Auth::logout();
        Session::flush(); // remove the session cookiest
        return redirect(route('login'))->with('success', 'Logout Successful');
    }
}
