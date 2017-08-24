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
}
