<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

//    public function handleSocialPlatformCallback()
//    {
//        $socialiteUser = Socialite::driver('google')->user();
//        dump($socialiteUser);
//        $this->createUser($socialiteUser);
//        dump(Auth::user());
////        return redirect()->route('home');
//    }

//    private function createUser(SocialiteUser $socialiteUser)
//    {
////        $user = new User();
////        $user->name = $socialiteUser->getName();
////        $user->email = $socialiteUser->getEmail();
////        $user->avatar = $socialiteUser->getAvatar();
////        $user->provider_id = $socialiteUser->getId();
////        $user->platform = 'google';
////        $user->save();
////        Auth::login($user);
//
//        $user = User::where('email', '=', $socialiteUser->email)->first();
//        if ( ! $user) {
//            $user = new User();
//            $user->name = $socialiteUser->getName();
//            $user->email = $socialiteUser->getEmail();
//            $user->avatar = $socialiteUser->getAvatar();
//            $user->provider_id = $socialiteUser->getId();
//            $user->platform = 'google';
//            $user->save();
//        }
//
//        Auth::login($user);
//    }
}
