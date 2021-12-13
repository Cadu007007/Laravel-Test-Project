<?php
namespace App\Http\Traits;

trait ResponsesJsonTrait{
    function success($message , $data = [])
    {
        return response()->json(['success'=>true,'message'=>$message,'data'=>$data],200);
    }
}