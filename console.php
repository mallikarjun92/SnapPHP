#!/usr/bin/env php
<?php

require_once __DIR__ . '/vendor/autoload.php';

use Core\Console\CommandManager;

// Check if a command is passed
if ($argc < 2) {
    echo "No command provided. Use 'php console.php help' for a list of commands.\n";
    exit(1);
}

$commandManager = new CommandManager();
$commandManager->run($argv);
