<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

// 增加便捷调用 User
//trait
class UsersController extends Controller
{
    public function __construct()
    {
        // 已认证用户 只能访问编辑 更新
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy'],
        ]);
        // 未登录用户 只能访问登录 注册
        $this->middleware('guest', [
            'only' => ['create'],
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 获取所有用户列表
        // $users = User::all();
        $users = User::paginate(10);
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required|max:50',
            'email'    => 'required|email|unique:users|max:255',
            'password' => 'required',
        ]);
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
        return redirect()->route('users.show', [$user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //根据接收到的 id 去数据库查找用户信息
        $user = User::findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // 根据传入的id 判断是哪个用户 然后进行操作
        $user = User::findOrFail($id);
        $this->authorize('update', $user); // 检查权限
        return view('users.edit', compact('user'));
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
        $this->validate($request, [
            'name'     => 'required|max:50',
            'password' => 'confirmed|min:6',
        ]);

        $user = User::findOrFail($id);
        $this->authorize('update', $user); // 检查权限
        // 根据id查找到相应用户 返回用户对象信息
        // 因为只能更改名字和密码，就只更新名字和密码
        // 从根源上确保不会被更改邮箱
        // 进行优化 如果用户 有更改密码 在进行密码更改
        // 否则只更新用户名
        $data         = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);
        session()->flash('success', '个人资料更新成功！');
        return redirect()->route('users.show', $id);
    }

    /**
     * Remove the specified resource from storage.
     * 1 根据传入的 id 去数据库查找数据
     * 2 调用user的destroy方法
     * 3 弹出提示
     * 4 返回上一页
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // 权限认证
        $this->authorize('destroy', $user);
        $user->destroy($id);
        session()->flash('success', '删除用户成功！');
        return back();
    }
}
