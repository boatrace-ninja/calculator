<?php

namespace Boatrace\Ninja;

use DI\Container;
use DI\ContainerBuilder;

/**
 * @author shimomo
 */
class Calculator
{
    /**
     * @var \Boatrace\Ninja\MainCalculator
     */
    protected $calculator;

    /**
     * @var \Boatrace\Ninja\Calculator
     */
    protected static $instance;

    /**
     * @var \DI\Container
     */
    protected static $container;

    /**
     * @param  \Boatrace\Ninja\MainCalculator  $calculator
     * @return void
     */
    public function __construct(MainCalculator $calculator)
    {
        $this->calculator = $calculator;
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return float
     */
    public function __call(string $name, array $arguments): float
    {
        return $this->calculator->$name(...$arguments);
    }

    /**
     * @param  string  $name
     * @param  array   $arguments
     * @return float
     */
    public static function __callStatic(string $name, array $arguments): float
    {
        return self::getInstance()->$name(...$arguments);
    }

    /**
     * @return \Boatrace\Ninja\Calculator
     */
    public static function getInstance(): Calculator
    {
        return self::$instance ?? self::$instance = (
            self::$container ?? self::$container = self::getContainer()
        )->get('Calculator');
    }

    /**
     * @return \DI\Container
     */
    public static function getContainer(): Container
    {
        $builder = new ContainerBuilder;
        $builder->addDefinitions(__DIR__ . '/../config/definitions.php');
        return $builder->build();
    }
}
