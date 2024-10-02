<?php

use \core\Router;
use \app\HomeController;

$router = new Router();

// add/define all the routes as required
$router->add('/', [new HomeController(), 'index']);
$router->add('/about', [new HomeController(), 'about']);


$router->dispatch($_SERVER['REQUEST_URI']);