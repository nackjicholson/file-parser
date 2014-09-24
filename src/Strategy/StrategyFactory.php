<?php

namespace Nack\FileParser\Strategy;

use Symfony\Component\Yaml\Parser;

/**
 * Creates parsing strategies, instances of StrategyInterface.
 */
class StrategyFactory implements StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvColumnsStrategy.
     *
     * @return CsvColumnsStrategy
     */
    public function createCsvColumnsStrategy()
    {
        return new CsvColumnsStrategy();
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
