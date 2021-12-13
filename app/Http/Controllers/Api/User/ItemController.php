<?php

namespace App\Http\Controllers\Api\User;

use App\Models\ItemStorage;
use Illuminate\Http\Request;
use App\Http\Services\ItemService;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
        $this->middleware(['jwt.verify','auth:user']);
    }

    public function index()
    {
        return $this->itemService->getAll();
    }

    public function store($id)
    {
        $currentUser = auth('user')->user();
        ItemStorage::create(['storage_id'=>$currentUser->storage->id,'item_id'=>$id]);
        return $this->success('Item Added To Your Storage Successfully');
    }

   
}
