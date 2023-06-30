<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
       /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        

        // get user from database
        if(!Auth::attempt($credentials)){
            return response()->json([
                'message' => 'Invalid login details'
            ], 401);
        }
        
        // if ($user) {
        //     $request->session()->regenerate();
        //     return response('Your are logged in!', 200)
        //           ->header('Content-Type', 'json');
        // }
 
        // return response('That email and password combination does not exist!', 400)
        //           ->header('Content-Type', 'json');
        $request->session()->regenerate();
    }
    public function logout(Request $request)
    {
      Auth::logout();
      $request->session()->invalidate();
      $request->session()->regenerateToken();
    }

    
    public function me(Request $request)
    {
      return response()->json([
        'data' => $request->user(),
      ]);
    }

}
