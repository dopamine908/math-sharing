<?php

namespace App\Policies;

use App\Models\Like;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LikePolicy
{
    use HandlesAuthorization;

    public function delete(User $user, Like $like): bool
    {
        return $user->id == $like->users_id;
    }
}
