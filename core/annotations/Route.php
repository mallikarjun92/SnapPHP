<?php

namespace Core\Annotations;

/**
 * @Annotation
 * @Target("METHOD")
 */
class Route
{
    private $method;
    private $path;
    private $name;

    public function __construct(array $values)
    {
        $this->method = $values['method'];
        $this->path = $values['path'];
        $this->name = $values['name'] ?? null;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getName()
    {
        return $this->name;
    }
}
