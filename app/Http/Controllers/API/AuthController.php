<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
        ]);

        return response()->json(['status'=>201]);
    }
    public function login()
    {
        $user = User::whereEmail(request('username'))->first();

        if(!$user){
            return response()->json([
                'message'=>'Не верно указан email или пароль',
                'status'=> 422
            ], 422);
        }

        if (!Hash::check(request('password'), $user->password)){
            return response()->json([
                'message'=> 'Не верно указан email или пароль',
                'status'=> 422
            ], 422);
        }

        $data = [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => 'dQWBiWXr2jeyMUGVvR0oJLLId0ctLNxkt9DEYE7M',
            'username'=> request('username'),
            'password'=> request('password'),
        ];
        $request = Request::create('/oauth/token', 'POST', $data);

        $response = app()->handle($request);

        if($response->getStatusCode() !=200) {
            return response()->json([
                'message'=>'Не верно указан email или пароль',
                'status' => 422
            ], 422);
        }
        $data = json_decode($response->getContent());

        return response()->json([
           'token'=>$data->access_token,
           'user'=> $user,
           'status'=> 200
        ]);
    }

    public function logout()
    {
        $accessToken = auth()->user()->token();

        $refreshToken = DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $accessToken->id)
            ->update([
                'revoked'=>true
            ]);
        $accessToken->revoke();
        return response()->json(['status'=>200]);
    }
    public function getUser()
    {
        return auth()->user();
    }
}
