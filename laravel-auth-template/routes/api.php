<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\MenuControllerApi;
use App\Http\Controllers\API\EventiControllerApi;
use App\Http\Controllers\API\ChiSiamoControllerApi;

// Rotte API per il Menu
Route::get('/menu', [MenuControllerApi::class, 'index']);

// Rotte API per Eventi
Route::get('/eventi', [EventiControllerApi::class, 'index']);

// Rotte API per Chi Siamo
Route::get('/chi-siamo', [ChiSiamoControllerApi::class, 'index']);

// Rotta autenticata
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', [MenuControllerApi::class, 'getCategories']);

