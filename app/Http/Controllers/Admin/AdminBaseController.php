<?php namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminBaseController extends Controller
{

    protected $viewData = [];
	protected $_error_code = NULL;

    public function __construct()
    {
        $this->initUser();
        return TRUE;
    }

	protected function viewData($k, $v)
	{
		$this->viewData[$k] = $v;
	}

    private function initUser()
    {
    }

//	/**
//	 * Show view.
//	 *
//	 * @param $view
//	 * @param array $data
//	 * @param array $mergeData
//	 * @return mixed
//	 */
//	public function view($view, $data = array(), $mergeData = array())
//	{
//		return view($view, $data, $mergeData);
//	}

//	/**
//	 * Redirect to a route.
//	 *
//	 * @param $route
//	 * @param array $parameters
//	 * @param int $status
//	 * @param array $headers
//	 * @return mixed
//	 */
//	public function redirect($route, $parameters = array(), $status = 302, $headers = array())
//	{
//		return redirect()->route($route, $parameters, $status, $headers);
//	}

}