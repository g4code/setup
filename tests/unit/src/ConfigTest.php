<?php

namespace G4\Setup\Test\Unit;

use G4\Setup\Config;
use G4\ValueObject\RealPath;

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @var Config
     */
    private $config;

    /**
     * @var PHPUnit_Framework_MockObject_MockObject
     */
    private $filePathMock;

    public function test()
    {
    }


    protected function setUp()
    {
        $this->filePathMock = $this->getMockBuilder(RealPath::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->config = new Config($this->filePathMock);
    }

    protected function tearDown()
    {
        $this->filePathMock = null;
        $this->config       = null;
    }
}
