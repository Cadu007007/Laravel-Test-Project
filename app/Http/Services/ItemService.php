<?php
namespace App\Http\Services;

use Illuminate\Support\Facades\Http;

class ItemService extends BaseService
{
    public function getAll()
    {
        $path = 'get-all';
       return $this->callUrl($path);
    }

    public function add($data)
    {
        $path = "create?title={$data['title']}&description={$data['description']}" ;
        return $this->callUrl($path,'post');
    }
    
    public function update($data)
    {
        $path = "edit?title={$data['title']}&description={$data['description']}&item_id={$data['item_id']}";
        return $this->callUrl($path,'post');
    }
    public function delete($id)
    {
        $path = "delete?item_id=".$id;
        return $this->callUrl($path);
    }
    private function callUrl($path,$requestType = 'get')
    {
        return Http::withHeaders(['accept'=>'application/json'])
        ->withBody(json_encode(['username'=>config('wordpress.username'),'password'=>config('wordpress.password')]),'json')
        ->$requestType(config('wordpress.host').'/wp-json/items/'.$path)->json();
    }
}