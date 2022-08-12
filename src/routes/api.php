<?php


use App\Http\Controllers\API\v1\Answer\AnswerController;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\Channel\ChannelController;
use App\Http\Controllers\API\v1\Subscribe\SubscribeController;
use App\Http\Controllers\API\v1\Thread\ThreadController;
use App\Http\Controllers\API\v1\User\UserController;
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

    //AUTH ROUTES
    Route::prefix('/auth')->controller(AuthController::class)->group( function() {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/user/info', 'userInfo')->middleware('auth')->name('user.info');
    });

    //USER ROUTES
    Route::prefix('users')->controller(UserController::class)->group(function () {
        Route::get('/leaderboards', 'leaderboard')->name('leaderboard');
    });


    //CHANNEL ROUTES
    Route::resource('channels', ChannelController::class);

    //THREAD ROUTES
    Route::resource('threads', ThreadController::class);

    //ANSWER ROUTES
    Route::prefix('threads')->resource('answers', AnswerController::class);

    //SUBSCRIBE ROUTES
    Route::prefix('threads')->resource('subscribes', SubscribeController::class);


});

