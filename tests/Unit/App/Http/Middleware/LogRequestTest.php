<?php namespace Tests\Unit\App\Http\Middleware;

use App\Http\Middleware\LogRequests;
use Illuminate\Http\Request;
use Tests\TestCase;

class LogRequestTest extends TestCase
{
    public function test_log_requests_to_file()
    {
        $logger_middleware = new LogRequests();

        $uri = '/uri.php?val=1';
        $method = 'POST';
        $data = ['key'=>'value'];
        $request = Request::create($uri, $method, $data);

        $logger_middleware->handle($request, function(){});
        $actual = $this->getLastLineOfLogFile();

        $expected = "Request: $method $uri {\"key\":\"value\",\"val\":\"1\"}\n";

        $this->assertEquals($expected, $actual);
    }

    private function getLastLineOfLogFile()
    {
        $log_filepath = base_path(LogRequests::LOG_FILEPATH);
        return `tail -n 1 $log_filepath`;
    }
}