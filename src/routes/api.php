<?php


use App\Http\Controllers\API\v1\Answer\AnswerController;
use App\Http\Controllers\API\v1\Auth\AuthController;
use App\Http\Controllers\API\v1\Channel\ChannelController;
use App\Http\Controllers\API\v1\Thread\ThreadController;
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
    Route::prefix('/auth')->controller(AuthController::class)->group(function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
        Route::post('/logout', 'logout')->name('logout');
        Route::get('/user/info', 'userInfo')->name('user.info');
    });


    //CHANNEL ROUTES
    Route::prefix('channel')->controller(ChannelController::class)->group(function () {
        Route::get('/all', 'getChannel')->name('channel.all');
        Route::group(['middleware' => ['permission:Manage_Channels','auth:sanctum']], function () {
            Route::post('/create', 'createChannel')->name('channel.create');
            Route::put('/update', 'updateChannel')->name('channel.update');
            Route::delete('/delete', 'deleteChannel')->name('channel.delete');
        });
    });



    //THREAD ROUTES
    Route::resource('threads',ThreadController::class);

    //ANSWER ROUTES
    Route::prefix('threads')->resource('answers', AnswerController::class);





});

