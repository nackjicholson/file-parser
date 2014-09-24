<?php

namespace Nack\FileParser\Strategy;

/**
 * Interface describes methods for each of the buildable strategy classes.
 */
interface StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvStrategy.
     *
     * @return CsvStrategy
     */
    public function createCsvStrategy();

    /**
     * Creates a new instance of CsvColumnarStrategy.
     *
     * @return CsvColumnarStrategy
     */
    public function createCsvColumnarStrategy();

    /**
     * Creates a new instance of CsvRowsStrategy.
     *
     * @return CsvRowsStrategy
     */
    public function createCsvRowsStrategy();

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
