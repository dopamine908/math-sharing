<?php

namespace App\Services\Authentication;

use App\Models\User;
use App\Repositories\UserRepository;
use Laravel\Socialite\Contracts\User as SocialiteUser;

class SocialLoginService
{
    private UserRepository $UserRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->UserRepository = $userRepository;
    }

    public function findOrCreateUser(SocialiteUser $socialiteUser, string $socialPlatform): User
    {
        $user = $this->UserRepository->getUserByEmailAndPlatform(
            email:    $socialiteUser->getEmail(),
            platform: $socialPlatform,
        );

        // user 不存在就註冊一個新的 user
        if (is_null($user)) {
            $user = $this->createNewUser(
                socialiteUser:  $socialiteUser,
                socialPlatform: $socialPlatform
            );
        }
        return $user;
    }


    private function createNewUser(SocialiteUser $socialiteUser, string $socialPlatform)
    {
        return $this->UserRepository->createUser(
            name:        $socialiteUser->getName(),
            email:       $socialiteUser->getEmail(),
            avatar:      $socialiteUser->getAvatar(),
            provider_id: $socialiteUser->getId(),
            platform:    $socialPlatform,
        );
    }
}
