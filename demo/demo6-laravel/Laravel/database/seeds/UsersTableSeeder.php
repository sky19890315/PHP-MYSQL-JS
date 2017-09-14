<?php
use Illuminate\Database\Seeder;

use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(User::class)->times(50)->make();
        User::insert($users->toArray());
        /**
         * 因为后期要进行回滚 以上工厂自动生成1-50个用户
         * 第一个用户也会变成假用户 
         * 所以我们需要对第一个用户进行更改
         * 变成我们常用的用户
         * @var [type]
         */
        $user = User::find(1);
        $user->name = 'ken';
        $user->is_admin = true;
         $user->activated = true;
        $user->email = 'sunkeyi2016@gmail.com';
        $user->password = bcrypt('123qwe');
        $user->save();
    }
}
