<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
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
     * 更新用户信息 只有本人才能更新他自己
     * @param  [type] $currentUser [description]
     * @param  [type] $user        [description]
     * @return [type]              [description]
     */
    public function update($currentUser, $user)
    {
        return $currentUser->id === $user->id;
    }

    /**
     * 只有管理员能删除用户 并且不能删除他本身
     * @param  [type] $currentUser [description]
     * @param  [type] $user        [description]
     * @return [type]              [description]
     */
    function destroy($currentUser, $user)
    {
        return $currentUser->is_admin && $currentUser->id !== $user->id;
    }
}
