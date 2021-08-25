<?php

use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/auth/{social_platform}/redirect', [SocialLoginController::class, 'redirectToSocialPlatform'])->middleware(
    [StartSession::class]
)->name('social-login.redirect');

Route::get(
    '/auth/{social_platform}/callback',
    [SocialLoginController::class, 'handleSocialPlatformCallback']
)->middleware(
    [StartSession::class]
)->name('social-login.callback');

Route::get('/auth/login_success', [SocialLoginController::class, 'handleSocialPlatformCallback'])->name(
    'social-login.success'
);

//Route::get('api/user')
