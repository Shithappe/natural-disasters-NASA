<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TestController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\EventsController;


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

Route::get('/get_categories', [CategoriesController::class, 'get_categories']);
Route::get('/set_categories', [CategoriesController::class, 'set_categories']);
Route::get('/set_events', [EventsController::class, 'set_events']);
Route::get('/get_events', [EventsController::class, 'get_events']);
Route::post('/get_by_category', [CategoriesController::class, 'get_events_by_category_id']);
