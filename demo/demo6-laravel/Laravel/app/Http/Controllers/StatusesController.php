<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;// 引入model
use App\Status;

class StatusesController extends Controller
{
    function __construct()
    {
        $this->middleware('auth', [
            'only'      =>  ['store', 'destroy']
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
        // 因为微博总是隶属于某个用户 
        // 就直接调用用户模型中的微博方法 来创建
        // 过滤
        $this->validate($request, [
                'content'   =>  'required|max:140'
            ]);
        /**
         * 链式调用 因为前面绑定了微博
         * 其实应该是直接user()->create
         * 也就是调用了User model的 create 方法
         */
        Auth::user()->statuses()->create([
            'content'   => $request->content
            ]);
        return redirect()->back();
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
        // 根据传入的id 进行查找
        // 首先必须要查找到数据 并放入一个对象中
        // 其次进行认证判断 通过验证后可删除
        // 验证也就是利用策略模式
        $status = Status::findOrFail($id);
        $this->authorize('destroy', $status);
        $status->delete($id);
         session()->flash('success', '微博已被成功删除！');
        return redirect()->back();
    }
}
