<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Resources\UserCollection;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware(['jwt.verify','auth:admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->success('',UserCollection::collection(User::with('storage')->paginate(10)));
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\UserRegisterRequest  $request
     */
    public function store(UserRegisterRequest $request)
    {
        $user = User::create($request->validated());
        return $this->success('User Created Successfully',UserCollection::collection(User::with('storage')->where('id',$user->id)->get())); 
    }
    
 
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UpdateUserRequest  $request
     * @param  User  $id
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        return $this->success('User Updated Successfully',UserCollection::collection(User::with('storage')->where('id',$user->id)->get())); 
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->storage()->delete();
        $user->delete();
        return $this->success('User Deleted Successfully'); 
    }
}
