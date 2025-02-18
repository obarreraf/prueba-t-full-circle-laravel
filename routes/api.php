<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Actions\Tasks\IndexTaskAction;
use App\Http\Actions\Tasks\StoreTaskAction;
use App\Http\Actions\Tasks\UpdateTaskAction;
use App\Http\Actions\Tasks\DestroyTaskAction;
use App\Http\Actions\Tasks\CompletedTasksLastWeekAction;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('tasks')->group(function () {
    Route::get('/', IndexTaskAction::class);
    Route::post('/', StoreTaskAction::class);
    Route::put('/{task}', UpdateTaskAction::class);
    Route::delete('/{task}', DestroyTaskAction::class);
    Route::get('/completed-last-week', CompletedTasksLastWeekAction::class);
});