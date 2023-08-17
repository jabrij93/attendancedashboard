<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $items = Item::get();
        return view('items.index', compact('items'));
    }

    public function create()
    {
        $items = Item::get();
        return view('items.index', compact('items'));
    }

    public function store(Request $request)
    {
        $images = null; // Initialize the variable outside the if statement

        if ($request->hasFile('images')) {
            $file = $request->file('images');
            $name = date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/item_images', $name);
            $images = $name;
        }

        $data = new Item;
        $data->name = $request->item;
        $data->type_id = $request->type_id;
        $data->user_id = $request->user_id;
        $data->images = $images;
        $data->save();

        return redirect()->route('item.index')->with('success', 'Item has been created successfully.');
    }

    public function detail() 
    {
        return view("items.detail");
    }

    public function addToCart(Request $request) 
    {
        return "Hello World !";
    }
}