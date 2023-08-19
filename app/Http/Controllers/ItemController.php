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

        // Generate random 8 characters product_id
        $alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $alphaPart = substr(str_shuffle($alphabet), 0, 3);
        $numericPart = str_pad(mt_rand(0, 99999), 5, '0', STR_PAD_LEFT);
        $productId = $alphaPart . $numericPart;

        $data = new Item;
        $data->name = $request->item;
        $data->type_id = $request->type_id;
        $data->user_id = $request->user_id;
        $data->images = $images;
        $data->price = $request->price;
        $data->product_id = $productId;
        $data->save();

        return redirect()->route('item.index')->with('success', 'Item has been created successfully.');
    }

    public function detail($id) 
    {
        $item = Item::find($id); // Fetch a single item

        if ($item) {
            return view('items.detail', compact('item'));
        } else {
            // Handle the case when no item is found
            return view('item.no-item');
        }
    }

    public function addToCart(Request $request) 
    {
        return "Hello World !";
    }
}