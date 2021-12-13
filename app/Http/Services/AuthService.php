<?php
namespace App\Http\Services;

use Tymon\JWTAuth\Facades\JWTAuth;

abstract class AuthService extends BaseService
{

    /**
     * get the guard to make authentication according to this guard
     *@var null
     **/
    abstract public  function  guard();
    /**
     * get the class name to use
     *@var null
     **/
    abstract public  function  model();

    /**
     * login function for all types
     *@var array
     **/
    public function login($data)
    {
       
        if (! $token = auth($this->guard())->attempt($data)) {
            $this->returnException('Un Authorized');
        }
       return $this->createNewToken($token);
    }

   
    /**
     * logout for current logged in guard 
     *@var null
     **/
    public function logout()
    {
        return auth($this->guard())->logout();
    }
    /**
     * refresh token for current guard
     *@var null
     **/
    public function refresh()
    {
        return $this->createNewToken(auth($this->guard())->refresh());
    }
    /**
     * return current guard login 
     *@var null
     **/
    public function getProfile()
    {
     
        return auth($this->guard())->user();
     
    }

    /**
     * register new model base in database
     *@var array
     **/
    public function register($data)
    {
        $user = $this->model()::create($data);
        $user['token'] = JWTAuth::fromUser($user);
        return $user;
    }
    
    
    protected function createNewToken($token){
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth($this->guard())->factory()->getTTL() * 60,
            $this->guard() => auth($this->guard())->user()
        ]);
    }
}