<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/**
 * @example /api/likes
 */
Route::post('/likes', [LikeController::class, 'store']);

/**
 * @example /api/likes
 */
Route::delete('/likes/{id}', [LikeController::class, 'destroy']);
