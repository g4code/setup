<?php

namespace G4\Setup;

use G4\Setup\Config\Config;
use Garden\Cli\Args;

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
        new Config();
    }
}
