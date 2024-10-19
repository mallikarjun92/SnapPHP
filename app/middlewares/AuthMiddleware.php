<?php

namespace App\Middlewares;

use Symfony\Component\HttpFoundation\Request;

class AuthMiddleware
{
    public function handle(Request $request)
    {
        if (!isset($_SESSION['user'])) {
            header('Location: /login');
            exit;
        }
    }
}
