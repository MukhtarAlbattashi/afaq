<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoinController;
use App\Http\Controllers\Api\GameController;
use App\Http\Controllers\Api\OrdersController;
use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::get('orders', [OrdersController::class, 'index']);
    Route::get('cards', [OrdersController::class, 'cards']);
    Route::post('orders/add', [OrdersController::class, 'add']);
    Route::post('product/add', [\App\Http\Controllers\Api\StoreController::class, 'buyProduct']);
    Route::get('getProducts', [\App\Http\Controllers\Api\StoreController::class, 'getStoreProduct']);

    Route::get('daily', [CoinController::class, 'daily']);
    // Route::post('increment/{coin}', [CoinController::class, 'increment']);
    Route::get('hint', [CoinController::class, 'hint']);
    Route::get('adscoins', [CoinController::class, 'adsCoins']);

    Route::post('accept-game', [GameController::class, 'acceptGame']);
    Route::post('get-state', [GameController::class, 'getGameState']);

    Route::post('lucky', [GameController::class, 'luckyWheel']);

    Route::get('setup', [\App\Http\Controllers\Api\Users\GetUsersInfoController::class, 'getUserInfo']);

});



// Route::post('login', [AuthController::class, 'login']);
// Route::post('register', [AuthController::class, 'register']);
Route::post('create', [AuthController::class, 'loginOrRegister']);


