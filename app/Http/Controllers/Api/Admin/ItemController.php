<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Http\Request;
use App\Http\Services\ItemService;
use App\Http\Controllers\Controller;
use App\Http\Requests\ItemsStoreRequest;
use App\Http\Requests\ItemsUpdateRequest;

class ItemController extends Controller
{
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
        $this->middleware(['jwt.verify','auth:admin']);
    }

    public function index()
    {
        return $this->itemService->getAll();
    }

    public function store(ItemsStoreRequest $request)
    {
        
        return $this->itemService->add($request->validated());
    }
    
    
    public function update(ItemsUpdateRequest $request)
    {

        return $this->itemService->update($request->validated());
    }
    
    public function destroy($id)
    {
        return $this->itemService->delete($id);
    }
}
