<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\ClassLoader\ApcClassLoader;

$loader = require_once __DIR__.'/../app/bootstrap.php.cache';

// Use APC for autoloading to improve performance.
// Change 'sf2' to a unique prefix in order to prevent cache key conflicts
// with other applications also using APC.

$load = new ApcClassLoader('nroho', $loader);
$load->register(true);

require_once __DIR__.'/../app/AppCache.php';
//require_once __DIR__.'/../app/appKernel.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();
$kernel = new AppCache($kernel);
$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();
$kernel->terminate($request, $response);
