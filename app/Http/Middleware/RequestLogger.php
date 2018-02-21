<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class RequestLogger
{
    const LOGFILE = "requests.log";
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $log_message = vsprintf('Request: %s %s %s', [
            $request->getMethod(),
            $request->getRequestUri(),
            json_encode($request->all())
        ]);

        Storage::disk('log')->append(self::LOGFILE, $log_message);

        return $next($request);
    }
}
