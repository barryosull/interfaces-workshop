<?php namespace App\Infrastructure\Http\Middleware;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    public static function makeMonolog(): LoggerInterface
    {
        $log = new Logger('name');
        $stream_filepath = base_path(Filepath::PATH);
        $log->pushHandler(new StreamHandler($stream_filepath));
        return $log;
    }
}