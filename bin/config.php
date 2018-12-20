<?php

$possibleAutoloadPaths = [
    join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'autoload.php']),
    join(DIRECTORY_SEPARATOR, [__DIR__, '..', '..', '..', 'autoload.php']),
    join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'vendor', 'autoload.php'])
];

$autoloadPath = null;

foreach ($possibleAutoloadPaths as $oneAutoloadPath) {
    if (file_exists($oneAutoloadPath)) {
        $autoloadPath = $oneAutoloadPath;
        break;
    }
}

if ($autoloadPath === null) {
    fputs(STDERR, "Missing autoload file!\n");
    exit(1);
}

require_once realpath($autoloadPath);

use Garden\Cli\Cli;


