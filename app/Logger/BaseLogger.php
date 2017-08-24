<?php namespace App\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

/**
 * @property \Monolog\Logger $_logger
 */
class BaseLogger
{
    protected function __construct($logPath, $channel, $format=NULL)
    {
        $output = $format?:"[%datetime%] %channel%.%level_name%: %message% %context%\n";
        // finally, create a formatter
        $formatter = new LineFormatter($output, 'Y-m-d H:i:s', TRUE);

        // Create a handler
        $stream = new StreamHandler($logPath, Logger::DEBUG);
        $stream->setFormatter($formatter);
        // bind it to a logger object
        $this->_logger = new Logger($channel);
        $this->_logger->pushHandler($stream);
    }

    public function emergency($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->emergency($msg, $context);
    }

    public function alert($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->alert($msg, $context);
    }

    public function critical($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->critical($msg, $context);
    }

    public function error($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->error($msg, $context);
    }

    public function warning($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->warning($msg, $context);
    }

    public function notice($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->notice($msg, $context);
    }

    public function info($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->info($msg, $context);
    }

    public function debug($msg, $context=[])
    {
        if($context) $msg = $msg.PHP_EOL;
        return $this->_logger->debug($msg, $context);
    }
}