<?php

namespace Core\Console\Commands;

class MakeView
{
    public function execute(array $arguments)
    {
        if (empty($arguments[0])) {
            echo "Please provide a name for the view.\n";
            return;
        }

        $viewName = $arguments[0] . '.html.twig';
        $path = __DIR__ . '/../../../views/' . $viewName;

        if (file_exists($path)) {
            echo "View already exists!\n";
            return;
        }

        $content = "{# Your view content here #}\n";
        file_put_contents($path, $content);
        echo "View $viewName created successfully.\n";
    }
}
