<?php
error_reporting(E_ALL);
define('BASE_PATH', dirname(__DIR__));
define('APP_PATH', BASE_PATH . '/app');

/**
 * The FactoryDefault Dependency Injector automatically registers
 * the services that provide a full stack framework.
 */
$di = new \Phalcon\Di\FactoryDefault();

/**
 * Handle routes
 */
include APP_PATH . '/config/router.php';

/**
 * Read services
 */
include APP_PATH . '/config/services.php';


/**
 * Get config service for use in inline setup below
 */
$config = $di->getConfig();

/**
 * Include Autoloader
 */
include APP_PATH . '/config/loader.php';

/**
 * Boot Whoops Error handler
 */
if($config->application->options->environment !== 'prod') {
    new \Whoops\Provider\Phalcon\WhoopsServiceProvider($di);
}

/**
 * Boot up the MVC application
 */
$application = new \Phalcon\Mvc\Application($di);

/**
 * Decide how to handle the request
 */
$handledRequest = $application->handle();

/**
 * Retrieve the Response from the request
 */
$content = $handledRequest->getContent();

/**
 * Output the Response
 */
echo str_replace(["\n","\r","\t"], '', $content);
