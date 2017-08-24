<?php namespace App\Logger;

class JsonLogger extends BaseLogger
{
    private static $_instance;
    protected $_logger;

    protected function __construct()
    {
        parent::__construct(storage_path().'/json_response.log', 'resp');
    }

    /**
     * @return self
     */
    public static function getInstance()
    {
        if(!isset(self::$_instance))
        {
            $c = __CLASS__;
            self::$_instance = new $c;
        }

        return self::$_instance;
    }
}