<?php

/**
 * Front controller
 *
 * PHP version 7.0
 */

/**
 * Composer
 */
require dirname(__DIR__) . '/vendor/autoload.php';

session_start();
/**
 * Error and Exception handling
 */
error_reporting(E_ALL);
set_error_handler('Core\Error::errorHandler');
set_exception_handler('Core\Error::exceptionHandler');


/**
 * Routing
 */
$router = new Core\Router();

// Add the routes
$router->add('', ['controller' => 'Home', 'action' => 'login']);
$router->add('login/', ['controller' => 'Home', 'action' => 'login']);
$router->add('login/valid', ['controller' => 'Home', 'action' => 'loginValid']);
$router->add('homepage', ['controller' => 'Home', 'action' => 'homepage']);
$router->add('logout/', ['controller' => 'Home', 'action' => 'logout']);
$router->add('admin/', ['controller' => 'AdminController', 'action' => 'admin']);
$router->add("candidatures/accept", ["controller" => "CandidaturesController", "action" => "accept"]);
$router->add("candidatures/refuse", ["controller" => "CandidaturesController", "action" => "refuse"]);
$router->add("postuler/", ["controller" => "CandidaturesController", "action" => "redirect"]);
$router->add("postuler/valid", ["controller" => "CandidaturesController", "action" => "postuler"]);
$router->dispatch($_SERVER['QUERY_STRING']);
