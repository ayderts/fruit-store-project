<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Models\User;
use App\Services\AuthService;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * @var AuthService
     */
    protected $authService;

    /**
     * AuthController constructor.
     * @param AuthService $authService
     */
    public function __construct( AuthService $authService )
    {
        $this->authService = $authService;
    }

    /**
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        return $this->authService->login($request->validated());
    }

    public function register(Request $request)
    {
        return $this->authService->register($request->all());
    }

    public function user()
    {
        return Auth::user();
    }
    public function logout(Request $request)
    {
        $cookie = Cookie::forget('jwt');
        return response()->json([
            'message' => 'Logout is successfull'
        ])->withCookie($cookie);
    }
}
