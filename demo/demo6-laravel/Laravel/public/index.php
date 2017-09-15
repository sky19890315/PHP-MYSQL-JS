<?php

/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylorotwell@gmail.com>
 */
/*
- laravel 入口文件分析
- 1 注册自动加载器
-  Composer提供了一个方便的自动生成的类加载器来加载
-  我们的应用。 我们只需要利用它！ 我们只需要它
-  进入这里的脚本，这样我们就不用担心我们需要在之后手动加载
-  任何我们用到的类。 放松身心很好
 */
/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels nice to relax.
|
*/

require __DIR__.'/../bootstrap/autoload.php';

/**
 * 打开灯(做了个必须,即引入 app 实例)
 * 我们需要照亮PHP开发，所以让我们开灯。
 * 这将引导框架并使其准备好使用，然后它
 * 将加载此应用程序，以便我们可以运行它并发送
 * 响应回到浏览器，并欢迎我们的用户。
 */
/*
|--------------------------------------------------------------------------
| Turn On The Lights
|--------------------------------------------------------------------------
|
| We need to illuminate PHP development, so let us turn on the lights.
| This bootstraps the framework and gets it ready for use, then it
| will load up this application so that we can run it and send
| the responses back to the browser and delight our users.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

/**
 *  运行应用
 *  一旦我们有了应用程序，我们可以处理传入的请求
 *  通过内核，并将关联的响应发送回
 *  客户的浏览器让他们享受创意
 *  和我们为他们准备的精彩应用。
 *
 *
 *
 *
 * 
 */
/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request
| through the kernel, and send the associated response back to
| the client's browser allowing them to enjoy the creative
| and wonderful application we have prepared for them.
|
*/

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);// 加载核心

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

$response->send();

$kernel->terminate($request, $response);// 终止请求响应 一次程序完成
