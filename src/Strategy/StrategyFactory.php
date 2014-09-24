<?php

namespace Nack\FileParser\Strategy;

use Symfony\Component\Yaml\Parser;

/**
 * Creates parsing strategies, instances of StrategyInterface.
 */
class StrategyFactory implements StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvStrategy.
     *
     * @return CsvStrategy
     */
    public function createCsvStrategy()
    {
        return new CsvStrategy();
    }

    /**
     * Creates a new instance of CsvColumnarStrategy.
     *
     * @return CsvColumnarStrategy
     */
    public function createCsvColumnarStrategy()
    {
        return new CsvColumnarStrategy();
    }

    /**
     * Creates a new instance of CsvRowsStrategy.
     *
     * @return CsvRowsStrategy
     */
    public function createCsvRowsStrategy()
    {
        return new CsvRowsStrategy();
    }

    /**
     * Creates a new instance of JsonStrategy.
     *
     * @return JsonStrategy
     */
    public function createJsonStrategy()
    {
        return new JsonStrategy();
    }

    /**
     * Creates a new instance of YamlStrategy, with a symfony/yaml parser.
     *
     * @return YamlStrategy
     */
    public function createYamlStrategy()
    {
        return new YamlStrategy(new Parser());
    }
}
