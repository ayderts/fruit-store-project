<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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


    public function login(LoginRequest $request) : JsonResponse
    {
        return $this->authService->login($request->validated());
    }
}
