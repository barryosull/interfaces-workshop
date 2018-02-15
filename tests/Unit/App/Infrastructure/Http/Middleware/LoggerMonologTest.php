<?php namespace Tests\App\Infrastructure\Http\Middleware;

use App\Infrastructure\Http\Middleware\Filepath;
use App\Infrastructure\Http\Middleware\LoggerFactory;
use Tests\TestCase;

class LoggerMonologTest extends TestCase
{
    public function test_log_requests_to_file()
    {
        $logger = LoggerFactory::makeMonolog();
        $message = "message";
        $logger->debug($message);

        $actual = $this->getLastLineOfLogFile();

        $expected = "name.DEBUG: message [] []\n";

        $this->assertEquals($expected, $this->removeDatetime($actual));
    }

    private function getLastLineOfLogFile()
    {
        $log_filepath = base_path(Filepath::PATH);
        return `tail -n 1 $log_filepath`;
    }

    private function removeDatetime($string)
    {
        return substr($string, 22);
    }
}