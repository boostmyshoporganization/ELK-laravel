<?php
$logService = new \Elk\Laravel\Services\Log;

Route::matched(array($logService, 'before'));
App::after(array($logService, 'after'));
/*
Route::matched(function($route, $request)
{
    var_dump($route->getCompiled());
    define('REQUEST_START', microtime(true));
    define('REQUEST_URI', $route->getPath());
    define('REQUEST_METHODS', implode(',', $route->getMethods()));
});

App::after(function($request, $response)
    {
        // echo REQUEST_METHODS.' | '.REQUEST_URI.' | '.(microtime(true) - REQUEST_START)."\n";
    });*/
