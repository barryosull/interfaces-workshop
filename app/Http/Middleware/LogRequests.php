<?php

namespace App\Http\Middleware;

use Closure;

class LogRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $filepath = storage_path("logs/requests.log");

        $log_message = "Request: ".sprintf(
            '%s %s %s %s',
            $request->getMethod(),
            $request->getRequestUri(),
            $request->server->get('SERVER_PROTOCOL'),
            $request->getContent()
        )."\r\n";

        file_put_contents($filepath, $log_message, FILE_APPEND);

        return $next($request);
    }
}
