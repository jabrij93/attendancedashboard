<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index($id = null)
    {
        if ($id) {
            $item = Item::find($id);
            if (!$item) {
                return response()->json(['error' => 'Item not found'], 404);
            }
            return response()->json($item);
        }
    
        $items = Item::get();
        return response()->json($items);
    }
}
