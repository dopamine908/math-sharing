<?php

use App\Http\Controllers\Auth\SocialLoginController;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    /**
     * 重新導向社群登入的 route
     * @example /auth/google/redirect
     */
    Route::middleware([StartSession::class])
        ->get('{social_platform}/redirect', [SocialLoginController::class, 'redirectToSocialPlatform'])
        ->name('social-login.redirect');

    /**
     * 給第三方登入平台 callback 的 route
     * @example /auth/google/callback
     */
    Route::middleware([StartSession::class])
        ->get('{social_platform}/callback', [SocialLoginController::class, 'handleSocialPlatformCallback'])
        ->name('social-login.callback');

    /**
     * 登出 route
     * @example /auth/logout
     */
    Route::get('logout', [SocialLoginController::class, 'logout'])
        ->name('logout');
});
