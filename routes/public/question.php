<?php

use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

/**
 * @example /api/questions/{id}
 */
Route::get('/questions/{id}', [QuestionController::class, 'show']);

/**
 * @example /api/questions
 */
Route::post('/questions', [QuestionController::class, 'store']);
