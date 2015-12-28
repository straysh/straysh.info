<?php namespace App\Http\Helpers\Observers;

use App\Http\Models\Frontend\Visitor;
use Illuminate\Support\Facades\Request;

class VisitorObserver
{

    /**
     * Handle the specified event.
     *
     * @return void
     */
    public function handle()
    {
        $isOnAdmin = Request::is('admin') || Request::is('admin/*');

        if (! $isOnAdmin) {
            Visitor::track();
        }
    }
}
