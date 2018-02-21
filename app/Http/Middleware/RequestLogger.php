<?php

namespace App\Http\Middleware;

use App\Infrastructure\Http\Middleware\LoggerNaive;
use Closure;
use Psr\Log\LoggerInterface;

class RequestLogger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $log_message = "Request: ".sprintf(
            '%s %s %s',
            $request->getMethod(),
            $request->getRequestUri(),
            json_encode($request->all())
        )."\n";

        $this->logger->info($log_message);
        
        return $next($request);
    }
}
