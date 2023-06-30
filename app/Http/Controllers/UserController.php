<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function createUser(Request $request){
        
        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        
    }

    
}
