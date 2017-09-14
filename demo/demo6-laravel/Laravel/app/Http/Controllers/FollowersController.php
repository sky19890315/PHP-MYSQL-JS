<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Auth;

class FollowersController extends Controller
{
    /**
     * 因为构造函数在类被实例化的时候自动调用
     * 所以用这个来进行调用中间件过滤
     */
    public function __construct()
    {
        $this->middleware('auth', [
            'store', 'destroy'
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // 1 根据传入id 查找用户并写入用户对象
        // 2 判断是当前用户是否有策略
        // 3 判断是否不是已经关注的用户
        // 4 不是已经关注的用户则可以点击关注
        // 5 关注后跳转回自己用户页面
        // 
         $user = User::findOrFail($request->id);

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (!Auth::user()->isFollowing($request->id)) {
            Auth::user()->follow($request->id);
        }

        return redirect()->route('users.show', $request->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // 这个过程跟关注完全相反
        $user = User::findOrFail($id);

        if (Auth::user()->id === $user->id) {
            return redirect('/');
        }

        if (Auth::user()->isFollowing($id)) {
            Auth::user()->unfollow($id);
        }

        return redirect()->route('users.show', $id);
    }
}
