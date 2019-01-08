<?php

namespace G4\Setup\Config;

use G4\Setup\StdioFacade;
use G4\ValueObject\StringLiteral;

class Info
{

    /**
     * @var StdioFacade
     */
    private $stdioFacade;


    private $data;

    /**
     * Info constructor.
     * @param StdioFacade $stdioFacade
     */
    public function __construct()
    {
        $this->data         = [];

//        $this->stdioFacade->setCallbackFunction([$this, 'infoCallback']);

    }

    public function gather()
    {
        $mysqlDataStructure = DataStructure::getMysqlData();
        $iterator = new \RecursiveIteratorIterator(new \RecursiveArrayIterator($mysqlDataStructure));
        foreach($iterator as $key => $value) {
            StdioFacade::getInstance()->write("{$key} - {$value}");
        }
    }

    public function infoCallback(StringLiteral $inputData)
    {

    }
}