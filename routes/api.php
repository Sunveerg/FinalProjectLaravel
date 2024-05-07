<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ItemController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShoppingCartController;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/sanctum/csrf-cookie', function (Request $request) {
    $token = $request->session()->token();
    return response([$token], 200);
});


Route::post('/ext/setUser', [UserController::class, 'setUser']);
Route::get('/ext/users', [UserController::class, 'getUsers']);
Route::get('/ext/users/{id}', [UserController::class, 'getUserById']);
Route::post('/ext/loginUser', [UserController::class, 'loginUser']);

Route::post('/ext/setItem', [ItemController::class, 'setItem']);
Route::get('/ext/getItems', [ItemController::class, 'getItems']);
Route::get('/ext/items/{search}', [ItemController::class, 'getItem']);

Route::get('/ext/shopping-cart', [ShoppingCartController::class, 'getShoppingCartByUserName']);

Route::post('/ext/addItem', [ShoppingCartController::class, 'addItemToShoppingCart']);

Route::get('/ext/searchItem', [ShoppingCartController::class, 'searchItemsInCart']);