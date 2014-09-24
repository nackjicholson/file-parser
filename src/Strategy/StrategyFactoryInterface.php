<?php

namespace Nack\FileParser\Strategy;

/**
 * Interface describes methods for each of the buildable strategy classes.
 */
interface StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvColumnsStrategy.
     *
     * @return CsvColumnsStrategy
     */
    public function createCsvColumnsStrategy();

    /**
     * Creates a new instance of JsonStrategy.
     *
     * @return JsonStrategy
     */
    public function createJsonStrategy();

    /**
     * Creates a new instance of YamlStrategy, with a symfony/yaml parser.
     *
     * @return YamlStrategy
     */
    public function createYamlStrategy();
}
