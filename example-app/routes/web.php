<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Tweet;
use App\Http\Controllers\Tweet\Update;
use App\Http\Controllers\Tweet\DeleteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group(['prefix' =>  'tweet', 'as' => 'tweet.'], function() {
    Route::get('/', Tweet\IndexController::class)->name('index');
    Route::post('/create', Tweet\CreateController::class)->name('create');

    Route::group(['prefix' =>  '/update', 'as' => 'update.'], function() {
        Route::get('{tweetId}', Update\IndexController::class)->name('index');
        Route::put('{tweetId}', Update\PutController::class)->name('put');
    });

    Route::delete('/delete/{tweetId}', DeleteController::class)->name('delete');
});

require __DIR__.'/auth.php';
