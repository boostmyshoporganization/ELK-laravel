<?php namespace Elk\Laravel\Services;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;

class Log
{
    const LOG_FILE = 'elk-laravel.log';
    protected $startTime;
    protected $startMemory;

    protected $action;
    protected $method;

    protected $logger;

    public function __construct()
    {
        $formatter = new \Monolog\Formatter\LineFormatter(
            '[%datetime%] %channel%.%level_name%: %message% %extra%'."\n",
            'c'
        );

        $handler = new StreamHandler(storage_path() . '/logs/elk-laravel.log');
        $handler->setFormatter($formatter);

        $this->logger = new Logger(strtoupper('elk-laravel'));
        $this->logger->pushHandler($handler);
    }

    public function before($route)
    {
        $this->startTime = microtime(true);
        $this->startMemory = memory_get_usage(true);
        $this->action = $route->getPath();
        $this->method = isset($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'cli';
    }

    public function after()
    {
        $time = round(microtime(true) - $this->startTime, 2);
        $memory = memory_get_usage(true) - $this->startMemory;
        $message = 'laravel | ' . $this->method . ' | ' . $this->action . ' | ' . $time . ' | ' . $memory;

        $this->logger->addInfo($message);
    }
}
