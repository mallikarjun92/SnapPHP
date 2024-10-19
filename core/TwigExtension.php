<?php

namespace Core;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigExtension extends AbstractExtension
{
    protected $router;

    public function __construct($router)
    {
        $this->router = $router;
    }

    /**
     * Registers custom functions to use in Twig.
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('asset', [$this, 'asset']),
            new TwigFunction('route', [$this, 'generateRoute']),
        ];
    }

    /**
     * Generate asset URL.
     * For example: {{ asset('css/style.css') }}
     *
     * @param string $path
     * @return string
     */
    public function asset($path)
    {
        // Assuming all assets are in the "public" folder
        return '/assets/' . $path;
    }

    /**
     * Generate URL for a named route.
     * For example: {{ route('home') }}
     *
     * @param string $name
     * @param array $params
     * @return string
     */
    public function generateRoute($name, $params = [])
    {
        return $this->router->getRouteByName($name, $params);
    }
}
