<?php
namespace App\Http\Traits;

use Illuminate\Http\Exceptions\HttpResponseException;

trait ThrowExceptionTrait{
    function returnException($message)
    {
        throw new HttpResponseException(response()->json(['success' => false, 'error' =>$message , 'data' => []], 401));

    }
}