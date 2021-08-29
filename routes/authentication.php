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
     * callback 玩判定登入成功之後會導向的登入成功 route
     * @example /auth/login_success?ott=XXXXXXXXXXXXXX
     */
    Route::get('login_success', [SocialLoginController::class, 'handleSocialPlatformLoginSuccess'])
        ->name('social-login.success');

    /**
     * 登入成功拿到 ott 之後
     * 讓前端拿 ott 來換真正的 access token 用的 route
     * @example /auth/access_token?ott=XXXXXXXXXXXXXX
     */
    Route::get('access_token', [SocialLoginController::class, 'getAccessToken'])
        ->name('social-login.access_token');

    /**
     * 登出 route
     * @example /auth/logout
     */
    Route::get('logout', [SocialLoginController::class, 'logout'])
        ->name('logout');
});
