<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function setUser(Request $request){
        $fields = $request->validate([
             'name'     => 'required|string'
            ,'password' => 'required|string'
        ]);
        $user = User::create([
             'name'     => $fields['name']
            ,'password' => $fields['password']
        ]);

        return response($user, 201);
    }

    public function getUsers(){
        $arryUsers = User::all();
        return response($arryUsers, 201);
    }

    public function getUserById($id)
    {
       
        $user = User::find($id);

        return response(array($user), 200);
    }

    public function loginUser(Request $request)
    {
        $fields = $request->validate([
            'username' => 'required|string'
           ,'password' => 'required|string'
       ]);

       
       $user = User::where('name', $fields['username'])->first();
       if (Hash::check($fields['password'], $user->password)) { 
           //unset($user['password']);*/
           return response(array($user), 200);
       }else{
           return response(array(), 200);
       }

    }
}
