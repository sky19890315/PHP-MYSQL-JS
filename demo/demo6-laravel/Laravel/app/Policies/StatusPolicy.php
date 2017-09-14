<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Status;

class StatusPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    /**
     * 删除策略  只有当现在登录用户和微博所属用户相等
     * 才能删除
     * @param  [type] $user   [description]
     * @param  [type] $status [description]
     * @return [type]         [description]
     */
    function destroy($user, $status)
    {   
        return $user->id === $status->user_id;
    }

}
