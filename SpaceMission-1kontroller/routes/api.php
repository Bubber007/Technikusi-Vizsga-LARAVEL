<?php

use App\Http\Controllers\DataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;

Route::get('/missions/{id}', [DataController::class, 'show']);
Route::get('/missions', [DataController::class, 'index']);
Route::post('/missions', [DataController::class, 'store']);
Route::delete('/missions/{id}', [DataController::class, 'destroy']);


Route::get('/commanders', [DataController::class, 'showCommanders']);
Route::post('/commanders', [DataController::class, 'storeCommander']);
Route::get('/commanders/count', [DataController::class, 'countCommanders']);


Route::get('/agency-missions', [DataController::class, 'AgencyGroup']);





