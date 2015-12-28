<?php namespace App\Http\Composers;

use App\Http\Models\Frontend\Permission;

class RoleFormComposer
{

    public function compose($view)
    {
        $permissions = Permission::lists('name', 'id');

        $view->with(compact('permissions'));
    }
}
