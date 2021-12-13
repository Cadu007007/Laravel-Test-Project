<?php
namespace App\Http\Services;

use App\Models\User;

class UserAuthService extends AuthService
{
  
    public function guard()
    {
        return 'user';
    }

    public function model()
    {
        return User::class;
    }
  
  
    
}