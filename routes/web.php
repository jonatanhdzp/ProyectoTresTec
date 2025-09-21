<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContractController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::resource('clientes', ClientController::class)
    ->parameters(["clientes" => "client"])
    ->names('client')
    ->except(['create', 'edit']);

Route::resource('contratos', ContractController::class)
    ->parameters(["contratos" => "contract"])
    ->names('contract')
    ->only('destroy');
