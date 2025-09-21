<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\ContractApiController;

Route::get('/clients', [ClientApiController::class, 'index']);
Route::post('/contracts', [ContractApiController::class, 'store']);
