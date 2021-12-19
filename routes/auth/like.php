<?php

use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Route;

/**
 * @example /api/likes
 */
Route::post('/likes', [LikeController::class, 'store']);
