<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Services\AdminAuthService;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminRegisterRequest;

class AdminAuthController extends Controller
{
    public function __construct(AdminAuthService $adminAuthService) {
        $this->adminAuthService =$adminAuthService;
        $this->middleware('auth:admin', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     */
    public function login(AdminLoginRequest $request){
    
       return $this->adminAuthService->login($request->validated());

    }

    /**
     * Register a Admin.
     *
     */
    public function register(AdminRegisterRequest $request) {
        $user= $this->adminAuthService->register($request->validated());
        return $this->success('Admin Successfully Registered',$user);
    }
    
    
    /**
     * Log the Admin out (Invalidate the token).
     *
     */
    public function logout() {
        $this->adminAuthService->logout();        
        return $this->success('Admin successfully signed out');
    }

    /**
     * Refresh a token.
     *
     */
    public function refresh() {
       return $this->adminAuthService->refresh();        
    }

    /**
     * Get the authenticated Admin.
     *
     */
    public function adminProfile() {
        $admin= $this->adminAuthService->getProfile();
        return $this->success('',['admin'=>$admin]);
    }


}
