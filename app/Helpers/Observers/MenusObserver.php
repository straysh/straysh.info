<?php namespace App\Helpers\Observers;

class MenusObserver
{

    /**
     * Handle the specified event.
     *
     * @return void
     */
    public function handle()
    {
        require app_path().'/Support/menus.php';
    }
}
