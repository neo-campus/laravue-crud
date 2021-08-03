<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'posts',
    'as'     => 'posts.',
], function(){
    Route::get('/',[PostsController::class,'index'])->name('index');
    Route::post('/store', [PostsController::class,'store'])->name('store');
    Route::get('/show/{id}', [PostsController::class,'show'])->name('show');
    Route::post('/update/{id?}', [PostsController::class,'update'])->name('update');
    Route::delete('/destroy/{id}', [PostsController::class,'destroy'])->name('destroy');
});


