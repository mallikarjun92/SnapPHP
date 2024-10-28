<?php

namespace Core\Console\Commands;

class MakeController
{
    public function execute(array $arguments)
    {
        if (empty($arguments[0])) {
            echo "Please provide a name for the controller.\n";
            return;
        }

        $controllerName = ucfirst($arguments[0]) . 'Controller';
        $defaulRoute = strtolower($arguments[0]);
        $path = realpath(__DIR__ . "\..\..\..\app\controllers");
        
        // Ensure the directory exists, or create it if it doesn't
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }

        $filePath = $path . DIRECTORY_SEPARATOR . $controllerName . '.php';

        if (file_exists($filePath)) {
            echo "Controller already exists! Path: '{$filePath}'\n";
            return;
        }

        $content = "<?php

namespace App\Controllers;

use Core\Controller;
use Core\Annotations\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class $controllerName extends Controller
{
    /**
     * @Route(method=\"GET\", path=\"/".$defaulRoute."\", name=\"".$defaulRoute."\")
     */
    public function index(Request \$request)
    {
        // Your code here

        // return respnse using template (make sure template '$defaulRoute.htm.twig' exists in /views)
        // return \$this->render('$defaulRoute.htm.twig', ['content' => 'Welcome to {$defaulRoute}']);

        return new Response(\"Welcome to $defaulRoute\", 200);
    }
}
";

        // Create the controller file
        file_put_contents($filePath, $content);
        echo "Controller $controllerName created successfully. Path: '{$filePath}'\n";
    }
}
