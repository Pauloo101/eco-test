<?php

use App\Http\Controllers\BreedController;
use App\Http\Controllers\UserController;
use App\Http\Services\DogCeo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::any('breed/{breed_id}/image', function ($id) {

});

Route::controller(BreedController::class)->group(function () {
    Route::any('breed', 'getAllBreeds');
    Route::any('breed/{breed_id}', "getBreedById");
    Route::any("bree/random", "getRandomBreed");
});

Route::post("user/{user_id}/associate",[UserController::class, "assoicateUserToType"]);
Route::post("park/{park_id}/breed", [UserController::class, "assoicateBreedToPark"]);
