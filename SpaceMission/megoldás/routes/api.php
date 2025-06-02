<?php

use App\Http\Controllers\AgencyController;
use App\Http\Controllers\CommanderController;
use App\Http\Controllers\MissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/missions/{id}', [MissionController::class, 'show']);
Route::get('/missions', [MissionController::class, 'index']);
Route::post('/missions', [MissionController::class, 'store']);
Route::delete('/missions/{id}', [MissionController::class, 'destroy']);

Route::get('/commanders', [CommanderController::class, 'index']);
Route::post('/commanders', [CommanderController::class, 'store']);
Route::get('/commanders/count', [CommanderController::class, 'count']);

Route::get('/agency-missions', [AgencyController::class, 'agencyMissions']);