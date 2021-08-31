<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class UserRepository
{
    public function createUser(
        string $name,
        string $email,
        string $avatar,
        string $providerId,
        string $platform,
    ): User {
        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->avatar = $avatar;
        $user->provider_id = $providerId;
        $user->platform = $platform;
        $user->save();
        return $user;
    }

    public function getUserByEmailAndPlatform(string $email, string $platform): User|Model|Builder|null
    {
        $queryBuilder = User::query();
        return $queryBuilder
            ->where('email', '=', $email)
            ->where('platform', '=', $platform)
            ->first();
    }
}
