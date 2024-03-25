<?php

use Illuminate\Http\Request;
use Illuminate\Contracts\Http\Kernel;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

// Create a new Laravel application instance
$app = require_once __DIR__.'/../bootstrap/app.php';

// Retrieve the HTTP kernel from the application container
$kernel = $app->make(Kernel::class);

// Handle the incoming request
$response = $kernel->handle(Request::capture());

// Send the response back to the client
$response->send();
