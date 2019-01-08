<?php

namespace G4\Setup;

use Clue\Commander\Router;
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

    /**
     * @var StdioFacade
     */
    private static $instance;


    private function __construct()
    {
        $this->loop     = Factory::create();
        $this->stdio    = new Stdio($this->loop);
        $router = new Router();
        $router->add('exit | quit', [$this, 'end']);
    }

    private function __clone() {}

    /**
     * @return StdioFacade
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new StdioFacade();
        }
        return self::$instance;
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

    public function end()
    {
        $this->stdio->end();
    }

    /**
     * @param StringLiteral $inputText
     */
    public function prompt(StringLiteral $inputText)
    {
        $this->stdio->getReadline()->setPrompt((string) $inputText);

        $this->stdio->on('data', [$this, 'callback']);
    }

    public function runLoop()
    {
        $this->loop->run();
    }

    /**
     * @param callable $callbackFunction
     */
    public function setCallbackFunction(callable $callbackFunction)
    {
        $this->callbackFunction = $callbackFunction;
    }

    public function write(...$line)
    {
        $this->stdio->write(join(' ', $line) . PHP_EOL);
    }

    public function writeAll(array $data)
    {
        $this->stdio->write('tralala' . PHP_EOL);
    }
}
