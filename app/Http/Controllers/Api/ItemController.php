<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * @return mixed
     */
    public function index()
    {
        return Item::orderBy('created_at', 'desc')->get();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->title = $request->item['title'];
        $newItem->user_id = auth()->id();
        $newItem->save();

        return response()->json([
            'message' => 'New item created.',
            'item' => $newItem
        ], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->title = $request->item['title'];
        $item->save();


        return response()->json([
            'message' => 'Item was updated.',
            'item' => $item
        ], 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function updateCheck(Request $request, $id)
    {
        $item = Item::findOrFail($id);
        $item->completed = $request->item['completed'] ? true : false;
        $item->completed_at = $request->item['completed'] ? Carbon::now() : null;
        $item->save();
        return $item;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $item = Item::findOrFail($id);
        $item->delete();
        return response()->json([
            'message' => 'Item deleted.',
            'item' => $item
        ]);
    }
}
