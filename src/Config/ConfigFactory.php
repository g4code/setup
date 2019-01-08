<?php

namespace G4\Setup\Config;

use G4\Setup\ParamsConsts;
use G4\ValueObject\Environment;
use G4\ValueObject\RealPath;
use G4\ValueObject\StringLiteral;

class ConfigFactory
{

    /**
     * @var array
     */
    private $data;

    /**
     * ConfigFactory constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @return Config
     */
    public function make()
    {
        $env        = new Environment($this->data[ParamsConsts::COMMAND_CONFIG_ARGUMENT_ENV]);
        $appName    = new StringLiteral($this->data[ParamsConsts::COMMAND_CONFIG_ARGUMENT_APP_NAME]);
        $saveTo     = new RealPath($this->data[ParamsConsts::COMMAND_CONFIG_ARGUMENT_SAVE_TO]);

        return new Config($env, $appName, $saveTo);
    }
}