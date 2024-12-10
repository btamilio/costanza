<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use Symfony\Component\ErrorHandler\Error\FatalError;
use App\Http\Middleware\ValidateAuthToken;
use App\Http\Middleware\ForcedResponseHeaders;
use Illuminate\Auth\AuthenticationException;

use Illuminate\Http\Request;
 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $middleware->append([
            ForcedResponseHeaders::class
        ]);


    })
    ->withExceptions(function (Exceptions $exceptions) {


        $exceptions->render(function (FatalError $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    "success" => FALSE,
                    "errors" => ["Something has gone wrong! We've got our team on it..."]
                ], 500);
            }
        });
 
        // Failed Sanctum Auth
        $exceptions->render(function (AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    "success" => FALSE,
                    "errors" => ['Not Authenticated']
                ], 401);
            }
        });


        ## anything /api/ should return JSON no matter what.
        $exceptions->shouldRenderJsonWhen(function (Request $request, Throwable $e) {
                return ($request->is('api/*')) ? TRUE : $request->expectsJson();
        });


    })->create();
