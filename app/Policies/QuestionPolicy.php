<?php

namespace App\Policies;

use App\Models\Question;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class QuestionPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Question $question): bool
    {
        return $user->id == $question->users_id;
    }

    public function delete(User $user, Question $question): bool
    {
        return $user->id == $question->users_id;
    }
}
