<?php

// use Core\Router;
// use Symfony\Component\HttpFoundation\Response;

// use App\Controllers\HomeController;

// // Initialized the router in boot()

// // Define routes with optional names
// $router->add('GET', '/', function() {
//     $controller = new HomeController();
//     return new Response($controller->index());
// }, 'home');


// $router->add('GET', '/about', function() {
//     $controller = new HomeController();
//     return new Response($controller->about());
// }, 'about');

use App\Controllers\HomeController;
// use App\Controllers\UserController;
use Core\Router;

// $router = new Router();

$router->add('GET', '/', [HomeController::class, 'index'], 'home');
// $router->add('GET', '/user/{id}', [UserController::class, 'show'], 'user_show');
// $router->add('POST', '/user/create', [UserController::class, 'store'], 'user_create');
$router->add('GET', '/about', [HomeController::class, 'home/about'], 'about');
