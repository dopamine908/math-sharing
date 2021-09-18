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

/**
 * @example /api/questions/{id}
 */
Route::patch('/questions/{id}', [QuestionController::class, 'update']);

/**
 * @example /api/questions/{id}
 */
Route::delete('/questions/{id}', [QuestionController::class, 'destroy']);
