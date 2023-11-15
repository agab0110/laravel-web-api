<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::prefix('auth')->group(function () {      // l'url sarà http://localhost:8000/api/auth/funzione
    Route::post('login', [AuthController::class, 'login']);
    Route::post('register', [AuthController::class, 'register']);
});

Route::middleware('auth:sanctum')->group(function () {      // protezione con il middleware auth:sanctum
    Route::prefix('v1')->group(function () {     // definizione delle routes per il gruppo di funzioni
        Route::apiResource('tasks', TaskController::class);     // apiResource fa si che vengano riconosciute all'interno della classe le funzioni come api
        Route::apiResource('projects', ProjectController::class);       // l'url in questo caso sarà http://localhost:8000/api/v1/(tasks o projects)/funzione
    });
});
