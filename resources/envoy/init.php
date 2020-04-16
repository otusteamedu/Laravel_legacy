<?php
/**
 * Description of init.php
 * @copyright Copyright (c) MISTER.AM, LLC
 * @author    Igor Abdrazakov <igor@mister.am>
 */

require __DIR__ . '/../../vendor/autoload.php';
$app = require_once __DIR__ . '/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
if (!$app->hasBeenBootstrapped()) {
    $app->bootstrapWith([
        \Illuminate\Foundation\Bootstrap\LoadEnvironmentVariables::class,
        \Illuminate\Foundation\Bootstrap\LoadConfiguration::class,
        \Illuminate\Foundation\Bootstrap\HandleExceptions::class,
        \Illuminate\Foundation\Bootstrap\RegisterFacades::class,
        \Illuminate\Foundation\Bootstrap\SetRequestForConsole::class,
        \Illuminate\Foundation\Bootstrap\RegisterProviders::class,
        \Illuminate\Foundation\Bootstrap\BootProviders::class,
    ]);
}
$app->loadDeferredProviders();

$dotenv = Dotenv\Dotenv::create(__DIR__ . '/../..');
$dotenv->load();