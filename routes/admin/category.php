<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

/**
 * 新增文章分類
 * @example /api/categories
*/
Route::post('/categories', [CategoryController::class, 'store']);
