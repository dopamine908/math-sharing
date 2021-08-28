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

class SocialLoginController extends Controller
{
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

        $user = $this->findOrCreateUser($socialiteUser, $socialPlatform);

        // TODO 先用 user id 當 ott ，之後要換成有時效性的 ott
        $oneTimeToken = Crypt::encrypt($user->id);

        return Redirect::route('social-login.success', ['ott' => $oneTimeToken]);
    }

    public function handleSocialPlatformLoginSuccess()
    {
        return view('login_success');
    }

    public function getAccessToken(Request $request)
    {
        // TODO 流程要再考量多一點的 edge case ，像是 decrypt 失敗或是 token 產失敗
        $userId = Crypt::decrypt($request->ott);
        $token = Auth::guard('api')->tokenById($userId);

        return Response::json(
            [
                'access_token' => $token,
                'token_type' => 'bearer',
                'expires_in' => Auth::guard('api')->factory()->getTTL() * 60 //sec
            ],
            200
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

    private function findOrCreateUser(SocialiteUser $socialiteUser, string $socialPlatform): User
    {
//        dump($socialiteUser);
//        dump($socialPlatform);
//        dump($socialiteUser->name);
        $query = User::query();
        $user = $query->where('email', '=', $socialiteUser->getEmail())
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
//        dump($socialiteUser->getName());
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
