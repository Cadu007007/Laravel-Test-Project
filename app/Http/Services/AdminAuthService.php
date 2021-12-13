<?php
namespace App\Http\Services;

use App\Models\Admin;

class AdminAuthService extends AuthService
{
    public function guard()
    {
        return 'admin';
    }

    public function model()
    {
        return Admin::class;
    }
}