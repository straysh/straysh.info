<?php namespace App\Exceptions;

/**
 * Created by PhpStorm.
 * User: straysh
 * Date: 2017/8/18
 * Time: 13:55
 * @method  array unknownError()
 */
class DevBaseException extends \Exception
{
    /**
     * Generate a HTTP response.
     */
    public function generateHttpResponse()
    {
        return ['fail'];
    }
}