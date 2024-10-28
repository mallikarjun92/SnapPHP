<?php

namespace Core\Console\Commands;

class MakeModel
{
    public function execute(array $arguments)
    {
        if (empty($arguments[0])) {
            echo "Please provide a name for the model.\n";
            return;
        }

        $modelName = ucfirst($arguments[0]);
        $path = __DIR__ . '/../../../app/models/' . $modelName . '.php';

        if (file_exists($path)) {
            echo "Model already exists!\n";
            return;
        }

        $content = "<?php\n\nnamespace App\Models;\n\nuse Core\Model;\n\nclass $modelName extends Model\n{\n    // Define your model properties and methods here\n}\n";

        file_put_contents($path, $content);
        echo "Model $modelName created successfully.\n";
    }
}
