<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TinderController;

Route::get('/tinder', [TinderController::class, 'index']);
Route::post('/tinder/interact', [TinderController::class, 'interact']);
Route::get('/liked', [TinderController::class, 'liked']);
Route::get('/app-store', [TinderController::class, 'appStore']);