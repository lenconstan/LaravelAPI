<?php

namespace App\Http\Controllers;

use App\Models\User;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
        $fields = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password'])
        ]);

        $token = $user->createToken('myapptoken')->plainTextToken;

        // get the token expiration time from env (in minutes)
        $token_expiration_time = env('TOKEN_EXPIRATION_TIME', 'null');
        
        // time untill which the token is valid (UTC)
        $valid_till = date("Y-m-d H:i:s", strtotime("+{$token_expiration_time} minutes"));

        $response = [
            'user' => $user,
            'token' => $token,
            'valid_till' => $valid_till
        ];

        return response($response, 201);

    }

    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // check email
        $user = User::where('email', $fields['email'])->first();

        // Check password
        if(!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        // create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        // get the token expiration time from env (in minutes)
        $token_expiration_time = env('TOKEN_EXPIRATION_TIME', 'null');
        
        // time untill which the token is valid (UTC)
        $valid_till = date("Y-m-d H:i:s", strtotime("+{$token_expiration_time} minutes"));


        $response = [
            'user' => $user,
            'token' => $token,
            'valid_till' => $valid_till
        ];

        return response($response, 201);

    }

    public function logout(Request $request) {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];

    }
}
