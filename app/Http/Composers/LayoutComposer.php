<?php namespace App\Http\Composers;

use Illuminate\Support\Facades\Request;

class LayoutComposer
{
    public function compose($view)
    {
    	$layout = config('admin.views.layout', 'backend.layouts.master');
        $currentUrl = Request::getUri();

        $view->with(compact('layout', 'currentUrl'));
    }
}
