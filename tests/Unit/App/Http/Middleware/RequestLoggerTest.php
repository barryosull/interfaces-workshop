<?php namespace Tests\Unit\App\Http\Middleware;

use Tests\TestCase;
use Illuminate\Http\Request;
use App\Http\Middleware\RequestLogger;
use Illuminate\Support\Facades\Storage;

class RequestLoggerTest extends TestCase
{
    public function test_log_requests_to_file()
    {
        Storage::fake('log');

        $logger_middleware = new RequestLogger();

        $uri = '/uri.php?val=1';
        $method = 'POST';
        $data = ['key'=>'value'];
        $request = Request::create($uri, $method, $data);

        $logger_middleware->handle($request, function(){});

        Storage::disk('log')->assertExists(RequestLogger::LOGFILE);
        $actual = Storage::disk('log')->get(RequestLogger::LOGFILE);
        $expected = "Request: $method $uri {\"key\":\"value\",\"val\":\"1\"}";
        $this->assertEquals($expected, $actual);
    }
}
