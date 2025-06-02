<?php

use App\Http\Controllers\AsteroidController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('asteroids', [AsteroidController::class, 'index']);
Route::post('asteroids', [AsteroidController::class, 'store']);
Route::delete('asteroids/{id}', [AsteroidController::class, 'destroy']);
Route::get('asteroids/discovered-after/{year}', [AsteroidController::class, 'discoveredAfter']);
Route::get('corporations/stat', [AsteroidController::class, 'stat']);