<?php

namespace Core\Console;

class CommandManager
{
    protected $commands = [
        'make:controller' => 'Core\Console\Commands\MakeController',
        'make:model' => 'Core\Console\Commands\MakeModel',
        'make:view' => 'Core\Console\Commands\MakeView',
        'help' => 'Core\Console\Commands\HelpCommand',
    ];

    public function run(array $args)
    {
        $command = $args[1] ?? 'help';
        $arguments = array_slice($args, 2);

        if (!isset($this->commands[$command])) {
            echo "Command not recognized. Use 'php console.php help' for assistance.\n";
            return;
        }

        $commandClass = $this->commands[$command];
        (new $commandClass())->execute($arguments);
    }
}
