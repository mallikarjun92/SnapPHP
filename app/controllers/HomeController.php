<?php

namespace App\Controllers;

use Core\Controller;
use Symfony\Component\HttpFoundation\Response;
use Core\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route(method="GET", path="/", name="home")
     */
    public function index(Request $request)
    {

        return $this->render('home.html.twig', ['message' => 'Welcome to SnapPHP!']);
    }

    /**
     * @Route(method="GET", path="/about", name="about")
     */
    public function about(Request $request)
    {
        return $this->render('about.htm.twig', ['content' => 'This is about page']);
    }

    /**
     * reserved for 404 page
     */
    public function notFound()
    {
        return $this->render('404.html.twig', ['content' => 'Page Not Found']);
    }
}
