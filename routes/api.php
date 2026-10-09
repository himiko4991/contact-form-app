<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/V1/contacts', [ContactController::class, 'index']);
Route::get('/V1/contacts/{contact}', [ContactController::class, 'show']);
Route::post('/V1/contacts', [ContactController::class, 'store']);
Route::put('/V1/contacts/{id}', [ContactController::class, 'update']);
Route::delete('/V1/contacts/{id}', [ContactController::class, 'destroy']);



