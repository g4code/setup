<?php

namespace G4\Setup;

use G4\ValueObject\StringLiteral;
use React\EventLoop\Factory;
use Clue\React\Stdio\Stdio;
use React\EventLoop\LoopInterface;

class StdioFacade
{

    /**
     * @var callable
     */
    private $callbackFunction;

    /**
     * @var LoopInterface
     */
    private $loop;

    /**
     * @var Stdio
     */
    private $stdio;


    public function __construct()
    {
        $this->loop     = Factory::create();
        $this->stdio    = new Stdio($this->loop);
    }

    /**
     * @param string $line
     */
    public function callback($line)
    {
        $this->stdio->pause();

        $line = rtrim($line, "\r\n");

        $this->stdio->write('Your input: ' . $line . PHP_EOL);

        if (is_callable($this->callbackFunction)) {
            call_user_func($this->callbackFunction, new StringLiteral($line));
        }
    }

    /**
     * @param StringLiteral $inputText
     */
    public function prompt(StringLiteral $inputText)
    {
        $this->stdio->getReadline()->setPrompt((string) $inputText);

        $this->stdio->on('data', [$this, 'callback']);

        $this->loop->run();
    }

    public function setCallbackFunction(callable $callbackFunction)
    {
        $this->callbackFunction = $callbackFunction;
    }
}
