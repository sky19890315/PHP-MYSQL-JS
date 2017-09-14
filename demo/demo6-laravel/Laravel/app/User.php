<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Auth;
class User extends Model implements AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    /**
     * 获取头像
     * @param  string $size [description]
     * @return [type]       [description]
     */
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=${size}";
    }
    /**
     * 监听回调函数
     * 当有用户创建 自动生成长度为30的随机字符令牌
     * @return [type] [description]
     */
    static function boot() 
    {
        parent::boot();
        static::creating(function ($user) {
             $user->activation_token = str_random(30);
        });
    }
    /**
     * 这个方法绑定了微博模型类
     * @return [type] [description]
     */
    function statuses()
    {
        return $this->hasMany(Status::class);
    }

    /**
     * 获取数据填充微博 总数据库中获取数据
     * 供给控制器调用
     * @return [type] [description]
     */
    function feed()
    {
        // return $this->statuses()->orderBy('created_at', 'desc');
        
        $user_ids = Auth::user()->followings->pluck('id')->toArray();
        array_push($user_ids, Auth::user()->id);
        return Status::whereIn('user_id', $user_ids)
                              ->with('user')
                              ->orderBy('created_at', 'desc');
    }

    /**
     * 获取粉丝关系列表
     * @return [type] [description]
     */
    public function followers()
    {
        return $this->belongsToMany(User::Class, 'followers', 'user_id', 'follower_id');
    }

    /**
     * 获取关注人列表
     * @return [type] [description]
     */
    public function followings()
    {
        return $this->belongsToMany(User::Class, 'followers', 'follower_id', 'user_id');
    }

    /**
     * 关注用户
     * @param  [type] $user_ids [description]
     * @return [type]           [description]
     */
    function follow($user_ids)
    {
        if (!is_array($user_ids)) {
             $user_ids = compact('user_ids');
        }
        $this->followings()->sync($user_ids, false);// 不同步
    }

    /**
     * 取消关注用户
     * @param  [type] $user_ids [description]
     * @return [type]           [description]
     */
    public function unfollow($user_ids)
    {
        if (!is_array($user_ids)) {
            $user_ids = compact('user_ids');
        }
        $this->followings()->detach($user_ids);
    }

    /**
     * 判断是否是关注的用户
     * @param  [type]  $user_id [description]
     * @return boolean          [description]
     */
    public function isFollowing($user_id)
    {
        return $this->followings->contains($user_id);
    }
}
