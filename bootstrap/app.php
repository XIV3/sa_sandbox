<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Set a global flag if we're running migrations
if (isset($_SERVER['argv'][1]) && 
    in_array($_SERVER['argv'][1], ['migrate', 'migrate:fresh', 'migrate:install', 
    'migrate:refresh', 'migrate:reset', 'migrate:rollback', 'migrate:status'])) {
    putenv('APP_MIGRATING=true');
}

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
