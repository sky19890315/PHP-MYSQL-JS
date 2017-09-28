<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Weibo;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
// 引入认证
use Auth;

class WeibosController extends Controller
{
    function __construct()
    {
         $this->middleware('auth', [
            'index'
        ]);
         // 抓号
        // $match = [];
        //  $getData = file_get_contents('http://www.weibo.com/login.php?category=1760');
        //  $pattent = '/<ul .*>(.*)<\/ul>/';
         
        //  $result = preg_match_all($pattent, $getData, $match);
        //  var_dump($match); 
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $weiboss = Weibo::paginate(10);
        return view('weibos.index', compact('weiboss'));//视图
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
        //
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
        //
    }
}
