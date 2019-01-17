<?php

namespace App\Policies;

use App\Member;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class MemberPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the premium.
     *
     * @param  \App\User $user
     * @param Member $member
     * @return boolean
     */
    public function range(User $user,Member $member):bool
    {
        return ($user->member->premium->category->category === 'pdg'
                || $user->member->premium->category->category === 'manager')
            && ($member->premium->status->status === 'active');
    }
}
