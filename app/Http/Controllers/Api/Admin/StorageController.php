<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Storage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\StorageCollection;
use App\Http\Requests\StorageStoreRequest;
use App\Http\Requests\StorageUpdateRequest;

class StorageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['jwt.verify','auth:admin']);
    }
 
    public function index()
    {
        return $this->success('',StorageCollection::collection(Storage::paginate(10)));
    }

    public function store(StorageStoreRequest $request)
    {
        $storage = Storage::create($request->validated());
        return $this->success('Storage Created Successfully',new StorageCollection($storage)); 
        
    }
    
    public function update(StorageUpdateRequest $request, Storage $storage)
    {
        $storage->update($request->validated());
        // fetch storage again because the current storage will not be change for current session fo storage var
        $storage = Storage::find($storage->id);
        return $this->success('Storage Updated Successfully',new StorageCollection($storage)); 
    }


    public function destroy(Storage $storage)
    {
        $storage->delete();
        return $this->success('Storage Deleted Successfully');
    }
}
