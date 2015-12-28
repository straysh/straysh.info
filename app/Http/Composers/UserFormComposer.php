<?php namespace App\Http\Composers;

use App\Http\Models\Frontend\Role;

class UserFormComposer
{

    public function compose($view)
    {
        $roles = Role::lists('name', 'id');

        $view->with(compact('roles'));
    }
}
