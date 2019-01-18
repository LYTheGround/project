<?php

namespace App\Policies;

use App\Position;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PositionPolicy
{
    use HandlesAuthorization;

    public function view(User $user,Position $position)
    {
        return $position->company_id === $user->member->company_id;
    }

    public function update(User $user, Position $position)
    {
        if($user->member->company_id == $position->company_id){
            if($user->member->id == $position->member_id){
                return true;
            }
            else{
                $category = $user->member->premium->category->category;
                if($category == 'pdg' || $category == 'manager'){
                    return true;
                }
            }
        }
        return false;
    }

}
