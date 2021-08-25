<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;

class SocialLoginController extends Controller
{
    public function redirectToSocialPlatform(string $socialPlatform)
    {
        // TODO 沒有使用(或驗證不合法)的社群登入要把他轉回首頁並帶錯誤 url query
//        if () {
//            return Redirect::route('home',['error'=>'wrong_social_platform']);
//        }
        return Socialite::driver($socialPlatform)->redirect();
    }

    public function handleSocialPlatformCallback(string $socialPlatform)
    {
        $socialiteUser = Socialite::driver($socialPlatform)->user();
        dump($socialiteUser);

        $user = $this->findOrCreateUser($socialiteUser, $socialPlatform);
        dump($user);
    }

    private function findOrCreateUser(SocialiteUser $socialiteUser, string $socialPlatform): User
    {
        $query = User::query();
        $user = $query->where('email', '=', $socialiteUser->email)
            ->where('platform', '=', $socialPlatform)
            ->first();

        // user 不存在就註冊一個新的 user
        if (is_null($user)) {
            $user = $this->createNewUser($socialiteUser, $socialPlatform);
        }
        return $user;
    }

    private function createNewUser(SocialiteUser $socialiteUser, string $socialPlatform)
    {
        $user = new User();
        $user->name = $socialiteUser->getName();
        $user->email = $socialiteUser->getEmail();
        $user->avatar = $socialiteUser->getAvatar();
        $user->provider_id = $socialiteUser->getId();
        $user->platform = $socialPlatform;
        $user->save();
        return $user;
    }
}
