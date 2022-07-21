<?php


use App\Http\Controllers\API\V01\Auth\AuthController;
use App\Http\Controllers\API\V01\Channel\ChannelController;
use Illuminate\Support\Facades\Route;

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


Route::prefix('v1')->group(function () {
    Route::prefix('/auth')->controller(AuthController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/user/info', 'userInfo')->name('user.info');
    });

    Route::prefix('channel')->controller(ChannelController::class)->group(function (){
        Route::get('/all','getAllChannels')->name('channel.all');
        Route::post('/create','createNewChannel')->name('channel.create');
        Route::put('/update','updateChannel')->name('channel.update');
    });
});

