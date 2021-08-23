<?php

use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Support\Facades\Route;

Route::get('/auth/{social_platform}/redirect', [SocialLoginController::class, 'redirectToSocialPlatform'])->name(
    'social-login.redirect'
);

//Route::get('/auth/google/callback', [SocialLoginController::class,'handleSocialPlatformCallback'])->name('social-login.callback');
