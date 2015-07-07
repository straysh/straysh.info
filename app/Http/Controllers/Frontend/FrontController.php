<?php namespace App\Http\Controllers\Frontend;

//use Illuminate\Support\Facades\App;

class FrontController extends Controller
{

    protected $viewData = [];
	protected $_error_code = NULL;

    public function __construct()
    {
	    $this->beforeFilter('@before');
        return TRUE;
    }

	public function before($route, $request)
	{
        $this->initUser();
	}

	protected function viewData($k, $v)
	{
		$this->viewData[$k] = $v;
	}

    private function initUser()
    {
    }

}