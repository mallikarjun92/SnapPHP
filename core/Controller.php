<?php

namespace Core;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


/**
 * 
 * 
 * @author malli
 *
 */
abstract class Controller
{
    protected $twig;
    protected $router;
    protected $request;

    public function __construct($router, $request)
    {
        $this->router = $router;
        $this->request = $request;

        $loader = new FilesystemLoader(__DIR__ . '/../views');
        $this->twig = new Environment($loader);

        // Register custom Twig extension
        $this->twig->addExtension(new TwigExtension($this->router));
    }

    /**
     * Render a view using Twig.
     *
     * @param string $template
     * @param array $data
     * @return Response
     */
    protected function render($template, $data = [])
    {
        $content = $this->twig->render($template, $data);
        return new Response($content);
    }

    /**
     * Redirect to a different route.
     *
     * @param string $route
     * @param array $params
     * 
     * TODO: Resolve getRouter issue
     * 
     */
    protected function redirectTo($route, $params = [])
    {

        $url = $this->router->getRouteByName($route, $params);

        return new Response('', 302, ['Location' => $url]);
    }

    /**
     * Load CSS or JS assets.
     *
     * @param string $type
     * @param string $path
     * @return string
     */
    protected function asset($type, $path)
    {
        $baseUrl = '/assets/';
        return $baseUrl . $path;
    }
    
    /**
     * 
     * @return Router
     */
    public function getRouter() : Router
    {
        return $this->router;
    }
}
