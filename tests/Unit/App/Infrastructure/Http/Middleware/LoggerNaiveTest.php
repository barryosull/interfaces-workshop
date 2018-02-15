<?php namespace Tests\App\Infrastructure\Http\Middleware;

use App\Infrastructure\Http\Middleware\LoggerNaive;
use App\Http\Middleware\LogRequests;
use Tests\TestCase;

class LoggerNaiveTest extends TestCase
{
    public function test_log_requests_to_file()
    {
        $logger = new LoggerNaive();
        $message = "message";

        $logger->debug($message);

        $actual = $this->getLastLineOfLogFile();

        $this->assertEquals($message, $actual);
    }

    private function getLastLineOfLogFile()
    {
        $log_filepath = base_path(LogRequests::LOG_FILEPATH);
        return `tail -n 1 $log_filepath`;
    }
}