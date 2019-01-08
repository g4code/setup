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
use G4\Setup\Setup;
use G4\Setup\ParamsConsts;

$cli = new Cli();
$cli->command(ParamsConsts::COMMAND_CONFIG)
    ->description(ParamsConsts::COMMAND_CONFIG_DESCRIPTION)
    ->opt(
        ParamsConsts::COMMAND_CONFIG_ARGUMENT_APP_NAME,
        ParamsConsts::COMMAND_CONFIG_ARGUMENT_APP_NAME_DESCRIPTION,
        true
    );

$args = $cli->parse($argv, true);

(new Setup($args))->run();
