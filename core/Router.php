<?php

namespace Core;

use App\Controllers\HomeController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use ReflectionMethod;

class Router
{
    private $routes = [];
    private $namedRoutes = [];

    /**
     * Adds a route with an optional name and support for dynamic parameters.
     *
     * @param string $method
     * @param string $path
     * @param callable|array $handler
     * @param string|null $name
     */
    public function add($method, $path, $handler, $name = null)
    {
        $path = rtrim($path, '/') ?: '/';
        $this->routes[] = compact('method', 'path', 'handler');

        if ($name) {
            $this->namedRoutes[$name] = $path;
        }
    }

    public function dispatch(Request $request, Debug $debug): Response
    {
        $method = $request->getMethod();
        $uri = rtrim($request->getPathInfo(), '/') ?: '/';

        foreach ($this->routes as $route) {
            if ($route['method'] !== $method) continue;
            $pattern = $this->convertToRegex($route['path']);

            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);
                $params = $matches;

                // Log the route matched (for debug purposes)
                $debug->logQuery("Matched route: <code>{$route['path']}</code> with method <code>{$method}</code>");

                if (is_callable($route['handler'])) {
                    return call_user_func_array($route['handler'], $params, $this);
                } elseif (is_array($route['handler'])) {
                    list($controllerClass, $action) = $route['handler'];

                    // Instantiate the controller and pass the Request object
                    $controller = new $controllerClass($this, $request);

                    // Use reflection to inject Request object if necessary
                    $reflectionMethod = new ReflectionMethod($controller, $action);
                    $parameters = $reflectionMethod->getParameters();
                    $args = [];

                    // TODO: fix getClass is deprecated issue
                    foreach ($parameters as $param) {
                        if ($param->getClass() && $param->getClass()->name === Request::class) {
                            $args[] = $request; // Inject the Request object
                        } else {
                            $args[] = $params[$param->name] ?? null; // Pass route parameters
                        }
                    }

                    // Call the controller's method dynamically
                    return $reflectionMethod->invokeArgs($controller, $args);
                }
            }
        }

        // return new Response('Page Not Found', 404);
        
        // log route query for dev
        $debug->logQuery("No route matches for: <code>{$uri}</code> with method <code>{$method}</code>");
        
        // send 404
        $home = new HomeController($this, $request);
        return $home->notFound();

    }

    private function convertToRegex($path)
    {
        return '#^' . preg_replace_callback('#\{(\w+)\}#', function ($matches) {
            return "(?P<" . $matches[1] . ">[^/]+)";
        }, $path) . '$#';
    }

    public function getRouteByName($name, $params = [])
    {
        if (!isset($this->namedRoutes[$name])) {
            throw new \Exception("Route not found: " . $name);
        }

        $path = $this->namedRoutes[$name];

        foreach ($params as $key => $value) {
            $path = str_replace('{' . $key . '}', $value, $path);
        }

        return $path;
    }
}
