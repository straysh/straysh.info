<?php namespace App\Helpers\Observers;

use App\Models\Frontend\Visitor;
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
