<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Actions\Tasks\IndexTaskAction;
use App\Http\Actions\Tasks\StoreTaskAction;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('tasks')->group(function () {
    Route::get('/', IndexTaskAction::class);
    Route::post('/', StoreTaskAction::class);
});