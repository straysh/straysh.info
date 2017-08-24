<?php namespace App\Http\Controllers\APIs\V1;
use App\Http\Controllers\Controller;
use App\Traits\JsonResponseData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-8-21
 * Time: 下午5:31
 */
class UserController extends Controller
{
    use JsonResponseData;

    public function show(Request $request)
    {
        return $this->success($request->user()->toArray());
    }
}