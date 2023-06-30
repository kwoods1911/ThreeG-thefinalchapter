<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Http\Controllers\LoginController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::post('/createuser',function(Request $request){
    // get post response input
    //post information to users table.
    $data = $request->all();

    // Retrieve flight by name or create it with the name, delayed, and arrival_time attributes...
$res = User::where('email',$data['email'])->first();

if ($data['password'] !== $data['confirmpassword']) 
                return response('Password do not match', 500)
                        ->header('Content-Type', 'json');

if($res)
    return response('Email already exists!', 500)
                  ->header('Content-Type', 'json');


                  
    $user = User::Create([
        'name'=> $data['name'], 
        'email' => $data['email'],
        'password'=> $data['password']
    ]);
    $user->save();
    return response('Account Successfully Created!', 200)
                  ->header('Content-Type', 'json');
});


// Route::get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', [LoginController::class, 'me'])->middleware('auth:sanctum');;





