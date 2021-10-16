<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Authentication\SocialLoginService;
use Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    private SocialLoginService $SocialLoginService;

    public function __construct(SocialLoginService $socialLoginService)
    {
        $this->SocialLoginService = $socialLoginService;
    }

    public function redirectToSocialPlatform(string $socialPlatform)
    {
        if ($socialPlatform !== 'google') {
            return Redirect::route('home', ['error' => 'wrong_social_platform']);
        }
        return Socialite::driver($socialPlatform)->redirect();
    }

    public function handleSocialPlatformCallback(string $socialPlatform)
    {
        if ($socialPlatform !== 'google') {
            return Redirect::route('home', ['error' => 'wrong_social_platform']);
        }

        $socialiteUser = Socialite::driver($socialPlatform)->user();
        $user = $this->SocialLoginService->findOrCreateUser($socialiteUser, $socialPlatform);
        $token = Auth::guard('api')->tokenById($user->id);

        return response(view('login_success')->render())
            ->withHeaders(
                [
                    'Authorization' => "Bearer {$token}"
                ]
            );
    }

    public function logout()
    {
        $isLogin = Auth::guard('api')->check();

        if ($isLogin) {
            Auth::guard('api')->logout();
        }
        return Response::json(
            [
                'message' => 'already logout'
            ],
            200
        );
    }
}
