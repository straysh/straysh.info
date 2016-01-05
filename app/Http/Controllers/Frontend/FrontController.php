<?php namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Helpers\ErrorCode;
use App\Http\Helpers\JsonHelper;
use App\Http\Helpers\Yutils;

class FrontController extends Controller
{
    protected $viewData = [];
    protected $_error_code = NULL;
    /**
     * @var \App\Http\Services\Yuser
     */
    protected $_user;

    public function __construct()
    {
        //父类没有构造函数
        $this->initUser();
    }

    private function initUser()
    {
//        $this->_user = App::make("Webuser");
//        $this->viewData['yuser'] = UserService::getInstance()->get($this->_user->uid);
    }

    protected function viewData($k, $v)
    {
        $this->viewData[$k] = $v;
    }

    protected function viewDataMerge($array)
    {
        if(is_array($array)) $this->viewData = array_merge($this->viewData, $array);
    }

    protected function setPageSize($pageSize)
    {
        $pageSize = abs((int)$pageSize);
        return Yutils::$PAGE_SIZE = ($pageSize >0 && $pageSize <=20) ? $pageSize : Yutils::$PAGE_SIZE;
    }

    /**
     * @param array $input
     * @param int $mode 1:常规/2:Sphinx搜索
     * @return
     */
    protected function pageParams($input, $mode=1)
    {
        $this->setPageSize(isset($input['pageSize'])?$input['pageSize']:0);
        $input['page'] = !empty($input['page']) ? $input['page'] : 1;
        $params['orderby'] = $this->parseOrderby( !empty($input['sortby'])? $input['sortby'] : '', $mode );
        $params['limit'] = Yutils::$PAGE_SIZE;
        $params['page'] = $input['page'] > 1 ? $input['page'] : 1;

        return $params;
    }

    private function parseOrderby($sortby, $mode)
    {
        if(empty($sortby) || !is_string($sortby)) return FALSE;

        $op = $sortby[0];
        if( '+' === $op ) $op = 'ASC';
        elseif( '-' === $op ) $op = 'DESC';
        else return FALSE;


        $name = array(
            'rating' => 'rating',
            'price' => 'price',
            'reviewed' => 'tabletalk_amount',
            'collected' => 'collected_amount'
        );
        $field = substr($sortby, 1);

        $result = array(
            'field' => isset($name[$field]) ? $name[$field] : NULL,
            'direction' => $op
        );

        if( 1 === $mode )
        {
            $result = "{$result['field']} {$result['direction']}";
        }

        return $result;
    }

    protected function resourceNotFound()
    {
        return JsonHelper::fail('resource not exists', ErrorCode::RESOURCE_NOT_EXISTS);
    }

    protected function checkRequired($params, $required=[])
    {
        return checkRequired($params, $required);
    }

    protected function redirectNotFound()
    {
        return redirect('/errors/404.html');
    }

    protected function redirectBack()
    {
        return back(200);
    }

}