<?php namespace App\Traits;

use App\Consts\ErrorCode;
use App\Logger\JsonLogger;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

/**
 * User: straysh / <jobhancao@gmail.com>
 * Date: 17-7-21
 * Time: 下午3:52
 */
Trait JsonResponseData
{
    public function json($data, $info = '', $status = 10000, array $options = array(), $status_code = 200)
    {
        $result = array();
        $result['data'] = $data;
        $result['info'] = $info;
        $result['status'] = $status;
        if (!isset($options['total']) && is_array($data))
            $result['total'] = count($data);
        if (empty($options['pagination']['maxPage'])) unset($options['pagination']);
        $result = array_merge($result, $options);
        if(env('RESP_LOG'))
            JsonLogger::getInstance()->info($this->respTitle($status_code), $result);
        return response()->json($result, $status_code);
    }

    private function respTitle($code)
    {
        $user = Auth::user();
        $uid = $user ? $user->id : '';
        $uri = request()->fullUrl();
        return "[{$uid}]{$code} {$uri}";
    }

    public function success($data = NULL, $options = array())
    {
        if (is_array($data) && array_key_exists('maxPage', $data)) {
            $options['pagination'] = ['maxPage' => $data['maxPage']];
            unset($data['maxPage']);
        }
        return $this->json($data, 'success', ErrorCode::NORMAL_SUCCESS, $options);
    }

    public function unknownError()
    {
        return $this->fail('unknown error');
    }

    public function fail($info = "fail", $errorCode = ErrorCode::NORMAL_FAILURE, $status_code = 200)
    {
        return $this->json(null, $info, $errorCode, [], $status_code);
    }

    public function invalidRequest()
    {
        return $this->json(null, 'invalid request', ErrorCode::REQUEST_NOT_AJAX);
    }

    public function invalidParams()
    {
        return $this->json(null, 'invalid parameters', ErrorCode::NORMAL_INVALID_PARAMETERS);
    }

    public function authExpired()
    {
        return $this->json(null, 'auth expired', ErrorCode::AUTH_EXPIRED);
    }

    public function authRejected()
    {
        return $this->json(null, 'auth rejected', ErrorCode::NOT_AUTHENTICATED);
    }

    public function mustLogin()
    {
        return $this->json(null, 'must login first', ErrorCode::MUST_LOGIN);
    }

    public function InternalDbFail()
    {
        return $this->json(null, 'internal fail', ErrorCode::DB_FAILURE);
    }

    public function returnJson($data, $info = '', $status = 10000, array $params = array())
    {
        $result = array();
        $result['data'] = $data;
        $result['info'] = $info;
        $result['status'] = $status;
        if (!isset($params['total']))
            $result['total'] = count($data);
        $result = array_merge($result, $params);
        $result['hash'] = md5(json_encode($result));
        return json_encode($result);
    }

    public function wrapResponse(Response $response)
    {
        $data = json_decode($response->getContent(), TRUE);
        if(isset($data['error']))
        {
            $response->setContent(json_encode([
                'data'   => null,
                'info'   => $data,
                'status' => ErrorCode::NORMAL_FAILURE
            ]));
        }else
        {
            $response->setContent(json_encode([
                'data'   => json_decode($response->getContent(), TRUE),
                'info'   => 'ok',
                'status' => ErrorCode::NORMAL_SUCCESS
            ]));
        }

        return $response;
    }
}