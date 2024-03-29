<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use App\Models\Status;
class StatusPolicy
{
    use HandlesAuthorization;

    public function destroy(User $user,Status $status)
    {
        return $user->id === $status->user_id;
    }
}
