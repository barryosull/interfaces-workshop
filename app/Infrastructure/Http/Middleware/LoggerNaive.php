<?php namespace App\Infrastructure\Http\Middleware;

use Psr\Log\AbstractLogger;

class LoggerNaive extends AbstractLogger
{
    public function log($level, $message, array $context = array())
    {
        $filepath = base_path(Filepath::PATH);
        file_put_contents($filepath, $message, FILE_APPEND);
    }
}