<?php

use App\Http\Actions\Tasks\IndexTaskAction;
use Illuminate\Support\Facades\Route;

Route::prefix('tasks')->group(function () {
    Route::get('/', IndexTaskAction::class);
});