<?php


namespace G4\Setup\Config;


use G4\Setup\StdioFacade;
use G4\ValueObject\Environment;
use G4\ValueObject\RealPath;
use G4\ValueObject\StringLiteral;

class Config
{

    /**
     * @var StringLiteral
     */
    private $appName;

    /**
     * @var Environment
     */
    private $environment;

    /**
     * @var RealPath
     */
    private $saveTo;

    /**
     * Config constructor.
     * @param Environment $environment
     * @param StringLiteral $appName
     * @param RealPath $saveTo
     */
    public function __construct(Environment $environment, StringLiteral $appName, RealPath $saveTo)
    {
        $this->environment  = $environment;
        $this->appName      = $appName;
        $this->saveTo       = $saveTo;
    }

    public function run()
    {
        $this->informationFactory()->gather();
    }

    /**
     * @return Info
     */
    public function informationFactory()
    {
        return new Info();
    }
}