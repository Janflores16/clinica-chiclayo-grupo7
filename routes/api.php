<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\RegistroTriajeController;

Route::prefix('v1')->group(function () {
    Route::apiResource('triaje', RegistroTriajeController::class);
});
