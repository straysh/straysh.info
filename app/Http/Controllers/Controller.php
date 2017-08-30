<?php

namespace App\Http\Controllers;

use App\Exceptions\DevBaseException;
use App\Traits\JsonResponseData;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Container\Container;
use Illuminate\Contracts\Debug\ExceptionHandler;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use JsonResponseData;

    protected $viewData = [];

    protected function withErrorHandling(\Closure $callback)
    {
        DB::beginTransaction();
        try{
            $response = $callback();
            DB::commit();
            return $response;
        }catch(DevBaseException $e)
        {
            DB::rollback();
            $this->exceptionHandler()->report($e);
            return $e->generateHttpResponse();
        }catch(\Exception $e){
            DB::rollback();
            if(!config('app.debug')) return $this->unknownError();
            throw $e;
        }
    }

    /**
     * Get the exception handler instance.
     *
     * @return \Illuminate\Contracts\Debug\ExceptionHandler
     */
    protected function exceptionHandler()
    {
        return Container::getInstance()->make(ExceptionHandler::class);
    }

    /**
     * @param array $input
     * @param int $mode 1:常规/2:Sphinx搜索
     * @return array
     */
    protected function pageParams($input, $mode=1)
    {
        $input['page'] = !empty($input['page']) ? $input['page'] : 1;
        $params['limit'] = 10;
        $params['page'] = $input['page'] > 1 ? $input['page'] : 1;

        return $params;
    }

    protected function pagination($page, $maxPage, $category=NULL)
    {
        $str = <<<PAGINATION
<div class="pagination">
        <a href="http://ymblog.net/">最前</a>
        <a href="http://ymblog.net/page/6/">上一页</a>
        <a href="http://ymblog.net/page/5/" class="inactive">5</a>
        <a href="http://ymblog.net/page/6/" class="inactive">6</a>
        <span class="current">7</span>
    </div>
PAGINATION;
        $html = [];
        $html[] = '<div class="pagination">';
        for($i=1;$i<=$maxPage;$i++)
        {
            $html[] = $i == $page
                ? sprintf('<span class="active">%s</span>', $i)
                : sprintf("<a href='/article/timeline?page=%1\$s%3\$s' class='%2\$s'>%1\$s</a>", $i, "", $category?"&category={$category}":"");
        }
        $html[] = '</div>';

        return implode('', $html);
    }
}
