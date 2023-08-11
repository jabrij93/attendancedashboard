<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $item = Item::get();
        return view('items.index', compact('item'));
    }
}