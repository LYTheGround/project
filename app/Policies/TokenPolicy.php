<?php

namespace App\Policies;

use App\User;
use App\Token;
use Illuminate\Auth\Access\HandlesAuthorization;

class TokenPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the token.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(User $user)
    {
        $category = $user->member->premium->category->category;

        return  ($category === 'pdg' || $category === 'manager');
    }

    /**
     * Determine whether the user can delete the token.
     *
     * @param  \App\User $user
     * @param Token $token
     * @return bool
     */
    public function delete(User $user,Token $token):bool
    {

        $category = $user->member->premium->category->category;

        return ($token->company_id === $user->member->company_id) && ($category === 'pdg' || $category === 'manager');

    }
}
