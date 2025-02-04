<?php

use App\Controllers\back\UserController;

use App\Core\Router;

$router = new Router();


$router->get('/register', [UserController::class, 'register']);
$router->post('/register', [UserController::class, 'handleRegister']);

$router->get('/login', [UserController::class, 'login']);
$router->post('/login', [UserController::class, 'handleLogin']);

$router->get('/logout', [UserController::class, 'logout']);

$router->dispatch();
