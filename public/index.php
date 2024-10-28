<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Core\Kernel;
use Dotenv\Dotenv;

// Load .env file
$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();
// TODO: $_ENV and set to approproite variable if neccessary

// Create request from globals
$request = Request::createFromGlobals();

// Initialize Kernel
$kernel = new Kernel();
$kernel->boot();

// Handle request and get response
$response = $kernel->handle($request);

// Send the response
$kernel->terminate($request, $response);
