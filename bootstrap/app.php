<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use \App\Http\Middleware\VerificarIPAutorizada;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'ip.autorizada' => \App\Http\Middleware\VerificarIPAutorizada::class,
        ]);
 
      
         app('router')->aliasMiddleware('role', \App\Http\Middleware\CheckRole::class);

    })
   
    
    
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

