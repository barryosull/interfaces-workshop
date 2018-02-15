<?php namespace App\Infrastructure\Http\Middleware;

use Psr\Log\AbstractLogger;

class LoggerNaive extends AbstractLogger
{
    const LOG_FILEPATH = "storage/logs/requests.log";

    public function log($level, $message, array $context = array())
    {
        $filepath = base_path(self::LOG_FILEPATH);
        file_put_contents($filepath, $message, FILE_APPEND);
    }
}