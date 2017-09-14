<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
 */
// 因为第二个是闭包 所以需要传入参数 传入的参数会和
// 闭包数据一起变化
$factory->define(App\User::class, function (Faker\Generator $faker) {
    // 设置时间戳
    $data_time = $faker->date . '' . $faker->time;
    // 在闭包中使用 static 关键字 是起到一个全局的作用
    // 不管类被实例化还是直接静态调用， 对静态变量的定义和修改都是对同一个变量的修改
    // 不论是父类还是子类,甚至是抽象类，只要能访问到静态变量，访问的都是同一个变量
    // 在闭包函数中,设置为static的变量， 同上面一样都是全局性的
    // 也就是说 第二次生成时 密码会调用前一次的密码 无论生成多少次
    // 每一个闭包内的密码都保持一样
    static $password;
    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'is_admin'       => false, 
        'activated'      => true,  
        'password'       => $password ?: $password = bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'created_at'     => $data_time,
        'updated_at'     => $data_time,
    ];
});

$factory->define(App\Status::class, function (Faker\Generator $faker) {
    $date_time = $faker->date . ' ' . $faker->time;
    return [
        'content'    => $faker->text(),
        'created_at' => $date_time,
        'updated_at' => $date_time,
    ];
});