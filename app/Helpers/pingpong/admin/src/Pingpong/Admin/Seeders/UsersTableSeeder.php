<?php namespace Pingpong\Admin\Seeders;

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\User;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        $user = User::create([
            'email' => 'jobhancao@gmail.com',
            'password' => '884168a@',
        ]);

        $user->addRole(1);
    }
}
