<?php

namespace App\Http\Controllers;

use App\Models\ShoppingCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ShoppingCartController extends Controller
{

    
    public function getShoppingCartByUserName(Request $request)
    {
        $userName = $request->query('user_name');

        if (!$userName) {
            return response()->json(['error' => 'User name required'], 400);
        }

        $carts = ShoppingCart::where('user_name', $userName)->with('items')->get();

        if ($carts->isEmpty()) {
            return response()->json(['message' => 'Shopping cart is empty'], 404);
        }

        return response()->json($carts, 200);
    }


    public function addItemToShoppingCart(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',
            'item_name' => 'required|string',
            'quantity' => 'required|integer|min:1'
        ]);
    
        $cart = ShoppingCart::firstOrCreate(['user_name' => $request->user_name]);
    
        $item = Item::where('name', $request->item_name)->firstOrFail();
        $existingCartItem = $cart->items()->where('item_name', $item->name)->first();
    
        if ($existingCartItem) {
            $existingCartItem->quantity += $request->quantity;
            $existingCartItem->total = $existingCartItem->quantity * $item->price;
            $existingCartItem->save();
        } else {
            $cart->items()->create([
                'item_name' => $item->name,
                'quantity' => $request->quantity,
                'total' => $request->quantity * $item->price
            ]);
        }
    
        return response()->json($cart->load('items'), 201);
    }
    public function searchItemsInCart(Request $request)
    {
        $request->validate([
            'user_name' => 'required|string',  
            'item_name' => 'required|string'  
        ]);

        $userName = $request->user_name;
        $itemName = $request->item_name;

        $cartItem = ShoppingCart::with('item')
                                ->where('user_name', $userName)
                                ->where('item_name', $itemName)
                                ->first();

        if (!$cartItem) {
            return response()->json(['message' => 'Item not found in cart'], 404);
        }

        return response()->json(['item' => $cartItem->item], 200);
    }
}
