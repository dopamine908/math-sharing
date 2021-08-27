<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Laravel\Socialite\Contracts\User as SocialiteUser;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

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

        $user = $this->findOrCreateUser($socialiteUser, $socialPlatform);

        // TODO 先用 user id 當 ott ，之後要換成有時效性的 ott
        $oneTimeToken = Crypt::encrypt($user->id);

        return Redirect::route('social-login.success', ['ott' => $oneTimeToken]);
    }

    public function handleSocialPlatformLoginSuccess(Request $request)
    {
        // TODO 流程要再考量多一點的 edge case ，像是 decrypt 失敗或是 token 產失敗
        $userId = Crypt::decrypt($request->ott);
        $token = Auth::guard('api')->tokenById($userId);
        return Response::json(
            [
                'access_token' => $token
            ],
            SymfonyResponse::HTTP_OK
        );
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
