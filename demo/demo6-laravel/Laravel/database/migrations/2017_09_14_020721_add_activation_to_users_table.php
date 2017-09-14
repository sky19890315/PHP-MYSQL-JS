<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivationToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // 本次迁移 增加两个字段 
            // 1 激活令牌
            // 2 判断用户是否激活
            // 本次为链式调用 封装了字符串的方法 和空的方法 
            // 会增加一列 属性为字符串的列 值为传入的值
            $table->string('activation_token')->nullable();
            $table->boolean('activated')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
             $table->dropColumn('activation_token');
             $table->dropColumn('activated');
        });
    }
}
