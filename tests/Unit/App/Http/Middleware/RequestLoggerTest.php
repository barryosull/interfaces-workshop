<?php namespace Tests\Unit\App\Http\Middleware;

use App\Http\Middleware\RequestLogger;
use Illuminate\Http\Request;
use Psr\Log\LoggerInterface;
use Tests\TestCase;

class RequestLoggerTest extends TestCase
{
    public function test_log_requests_to_file()
    {
        $logger = $this->prophesize(LoggerInterface::class);
        $uri = '/uri.php?val=1';
        $method = 'POST';
        $message = "Request: $method $uri {\"key\":\"value\",\"val\":\"1\"}\n";

        $logger->info($message)->shouldBeCalled();
        $logger_middleware = new RequestLogger($logger->reveal());

        $data = ['key'=>'value'];
        $request = Request::create($uri, $method, $data);
        $logger_middleware->handle($request, function(){});
    }
}