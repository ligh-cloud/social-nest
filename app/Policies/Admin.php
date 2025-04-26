<?php

namespace App\Policies;

use App\Models\User;

class Admin
{
    public function access(User $user)
    {
        return $user->role_id == 1;
    }
}
