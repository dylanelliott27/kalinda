<?php

use App\Http\Controllers\BillController;
use App\Http\Controllers\BillIssuerController;
use App\Http\Controllers\BillItemController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('/login', [UserController::class, 'login']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth:sanctum');
Route::get('/getAuthStatus', [UserController::class, 'getAuthStatus'])->middleware('auth:sanctum');


Route::resource('bills', BillController::class)->middleware('auth:sanctum');
Route::resource('bill_items', BillItemController::class)->middleware('auth:sanctum');
Route::resource('bill_issuers', BillIssuerController::class)->middleware('auth:sanctum');