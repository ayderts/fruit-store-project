<?php


namespace App\Services;


use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * @param array $credentials
     * @return JsonResponse
     */
    public function login(array $credentials) : JsonResponse
    {
        if (Auth::attempt(['login' => $credentials['login'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            $token = $user->createToken('MyAppToken')->accessToken;
            $cookie = cookie('jwt',$token,60*24);
            return response()->json([
                'status' => true,
                'access_token' => $token
            ])->withCookie($cookie);
        }
        return response()->json([
            'status' => false,
            'message' => 'Login or password are incorrect'
        ]);
    }
    public function register(array $request) : JsonResponse
    {
        $user = User::create([
            'name' => $request['name'],
            'login' =>$request['login'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json([
            'status' => true,
            'user' => $user
        ]);
    }
}
