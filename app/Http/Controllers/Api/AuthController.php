<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class AuthController extends Controller
{
  public function register(Request $request)
 {
      $validatedData = $request->validate([
          'name'=>'required|max:55',
          'email'=>'email|required|unique:users',
          'password'=>'required|confirmed'
      ]);

      // encrypting the password
      $validatedData['password'] = bcrypt($request->password);
      $user = User::create($validatedData);
      // create token
      $accessToken = $user->createToken('authToken')->accessToken;
      return response(['user'=> $user, 'access_token'=> $accessToken]);

 }

 public function login(Request $request)
  {
       $loginData = $request->validate([
           'email' => 'email|required',
           'password' => 'required'
       ]);

      // check data is valid or not
       if(!auth()->attempt($loginData)) {
           return response(['message'=>'Invalid credentials']);
       }
      $accessToken = auth()->user()->createToken('authToken')->accessToken;
      return response(['user' => auth()->user(), 'access_token' => $accessToken]);

  }
}
