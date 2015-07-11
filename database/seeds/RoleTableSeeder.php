<?php

use Illuminate\Database\Seeder;
use Pingpong\Admin\Entities\Role;

class RoleTableSeeder extends Seeder
{

    public function run()
    {
        Role::create([
            'name' => 'Administrator',
            'slug' => 'admin'
        ]);

        Role::create([
            'name' => 'User',
            'slug' => 'user'
        ]);
    }
}
