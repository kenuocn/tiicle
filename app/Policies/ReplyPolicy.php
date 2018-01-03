<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Reply;

class ReplyPolicy extends Policy {

    public function before($user, $ability)
    {
        if ($user->id == 1) {
            return true;
        }
    }

    public function update(User $user, Reply $reply)
    {
        return $user->isAuthorOf($reply);
    }

    public function destroy(User $user, Reply $reply)
    {
        return $user->isAuthorOf($reply) || $user->isAuthorOf($reply->topic);
    }
}
