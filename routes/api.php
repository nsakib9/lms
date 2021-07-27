<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/user', [UserController::class, 'userList']);
Route::post('/user/store', [UserController::class, 'store']);
Route::get('/user/show/{id}', [UserController::class, 'show']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);
Route::put('/user/edit/{id}', [UserController::class, 'update']);

