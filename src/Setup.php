<?php

namespace G4\Setup;

use G4\Setup\Config\ConfigFactory;
use G4\Setup\ParamsConsts;
use G4\Setup\Config\Config;
use G4\ValueObject\Environment;
use G4\ValueObject\RealPath;
use G4\ValueObject\StringLiteral;
use Garden\Cli\Args;
use phpDocumentor\Reflection\DocBlock\Tags\Param;

class Setup
{

    /**
     * @var Args
     */
    private $args;

    /**
     * Setup constructor.
     * @param Args $args
     */
    public function __construct(Args $args)
    {
        $this->args = $args;
    }

    public function run()
    {
        $stdioFacade = StdioFacade::getInstance();

        StdioFacade::getInstance()->write('Command:', $this->args->getCommand());
        StdioFacade::getInstance()->writeAll($this->args->getOpts());

        $stdioFacade->prompt(new StringLiteral('> '));

        if ($this->args->getCommand() === ParamsConsts::COMMAND_CONFIG) {
            $configFactory = new ConfigFactory($this->args->getOpts());
            $config = $configFactory->make();
            $config->run();
        }

        $stdioFacade->runLoop();
    }
}
