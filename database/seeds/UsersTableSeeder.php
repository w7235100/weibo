<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\User::class,50)->create();
        $user=\App\Models\User::find(1);
        $user->name='admin';
        $user->email='admin@qq.com';
        $user->password='admin';
        $user->is_admin=true;
        $user->save();
    }
}
