<?php

use App\Http\Controllers\Api\destinationsController;
use App\Http\Controllers\Api\HelloController;
use App\Http\Controllers\Api\itineraireListController;
use App\Http\Controllers\Api\itinerataireController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;

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

Route::group(['Middleware'=>'api'], function($routes){
    // if user authenticated
    Route::middleware(['jwt.auth'])->group(function (){
        Route::post('/itineraire', [itinerataireController::class,'itineraire']);
        Route::post('/itineraire/addList', [itineraireListController::class, 'storeList']);
        Route::get('/toVisit/list', [itineraireListController::class, 'displayList']);
        Route::put('/itineraire/update{id}', [itinerataireController::class, 'updateItineraire']);
        Route::post('/destinations', [destinationsController::class,'createDestination']);
        Route::get('/logout',[UserController::class,'logout']);
    });
    // Internaute
    Route::get('/itineraire/display', [itinerataireController::class, 'diaplayItineraire']);
    Route::post('/itineraire/search', [itinerataireController::class, 'search']);
    Route::post('/itinetaire/Filter', [itinerataireController::class, 'filter']);
    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });