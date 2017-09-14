<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    // 过滤函数
    protected $fillable = ['content'];
    /**
     * 建立微博与用户关系 一条微博属于一个用户
     * @return [type] [description]
     */
    function user()
    {
        return $this->belongsTo(User::class);
    }
}
