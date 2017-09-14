<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Auth;

// 增加便捷调用 User
//trait
// 调用邮件发送类
use Mail;

class UsersController extends Controller
{
    public function __construct()
    {
        // 已认证用户 只能访问编辑 更新
        $this->middleware('auth', [
            'only' => ['edit', 'update', 'destroy', 'followings', 'followers'],
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
        $this->sendEmailConfirmationTo($user);
        session()->flash('success', '验证邮件已发送到你的注册邮箱上，请注意查收。');
        return redirect('/');

       // Auth::login($user);
       // session()->flash('success', '欢迎，您将在这里开启一段新的旅程~');
       // return redirect()->route('users.show', [$user]);
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
        /**
         * 调用User Model的一个方法
         * @var [type]
         */
        $statuses = $user->statuses()->orderBy('created_at','desc')->paginate(10);
        return view('users.show', compact('user', 'statuses'));
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

    /**
     *  发送邮件
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
     protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'sunkeyi2016@gmail.com';
        $name = 'ken';
        $to = $user->email;
        $subject = "感谢注册 Sample 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }

    function confirmEmail($token)
    {
        // 查找用户信息
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;// 激活
        $user->activation_token = null;// 清空token
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }

    /**
     * 根据 id 获取用户数据
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function followings($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followings()->paginate(30);
        $title = '关注的人';
        return view('users.show_follow', compact('users', 'title'));
    }

    /**
     * 根据 ID 获取用户关注列表
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function followers($id)
    {
        $user = User::findOrFail($id);
        $users = $user->followers()->paginate(30);
        $title = '粉丝';
        return view('users.show_follow', compact('users', 'title'));
    }
}
