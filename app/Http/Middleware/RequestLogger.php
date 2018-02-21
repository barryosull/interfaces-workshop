<?php

namespace App\Http\Middleware;

use Closure;

class RequestLogger
{
    const LOG_FILEPATH = "storage/logs/requests.log";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $filepath = base_path(self::LOG_FILEPATH);

        $log_message = "Request: ".sprintf(
            '%s %s %s',
            $request->getMethod(),
            $request->getRequestUri(),
            json_encode($request->all())
        )."\n";

        file_put_contents($filepath, $log_message, FILE_APPEND);

        return $next($request);
    }
}
