<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
        if(Auth::check())
        {
            $cart = new Cart;
            $cart->user_id = Auth::id();  // Use Auth::id() to get the authenticated user's ID
            $cart->product_id = $request->product_id;
            $cart->save();

            return redirect()->back()->with('success', 'Item successfully added to cart');
        } else {
            return "TEST 2";
        }
    }

    public static function cartItem() 
    {
        if(Auth::check()) {
            return Cart::where('user_id', Auth::id())->get()->count();
        } else {
            // Handle the case where the user is not authenticated
            return []; // For example, return an empty array or an error message
        }
    }

    public static function myCart()
    {
        $userId = Auth::id();
        
        $cartItems = DB::table('cart')
            ->join('items', 'cart.product_id', '=', 'items.product_id')
            ->leftJoin('item_types', 'items.type_id', '=', 'item_types.id')
            ->select('cart.*', 'items.name', 'items.price', 'items.images', 'item_types.types')
            ->where('cart.user_id', $userId)
            ->get();
        
        return view('cart.index', compact('cartItems'));
    }
}