<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UserAuthService;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;

class UserAuthController extends Controller
{
    public function __construct(UserAuthService $userAuthService) {
        $this->userAuthService =$userAuthService;
        $this->middleware('auth:user', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request){
    
       return $this->userAuthService->login($request->validated());

    }

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request) {
        $user= $this->userAuthService->register($request->validated());
        return $this->success('User Successfully Registered',$user);
    }
    
    
    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        $this->userAuthService->logout();        
        return $this->success('User successfully signed out');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
       return $this->userAuthService->refresh();        
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        $user= $this->userAuthService->getProfile();
        return $this->success('',['user'=>$user]);
    }

  
}
