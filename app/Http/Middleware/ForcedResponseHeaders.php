<?php

namespace App\Http\Middleware;

use Closure;
 
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ForcedResponseHeaders
{
    public function handle($request, Closure $next)
    {

        $response = $next($request);

        $response->headers->remove("X-Powered-By");
        $response->headers->remove("Server");

        // $response->header("Cache-Control", "no-store");
        // $response->header("Pragma", "no-cache");
        // $response->header("Strict-Transport-Security", "max-age=315360000; includeSubDomains; preload");
        // $response->header("Content-Security-Policy", "upgrade-insecure-requests; default-src 'self' data: wss: https: 'unsafe-inline' 'unsafe-eval'");

        // $response->header("X-Costanza-Quote", "For I am Costanza; Lord of The Idiots.");
        
        return $response;

    }
}
