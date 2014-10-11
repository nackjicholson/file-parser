<?php

namespace Nack\FileParser\Strategy;

use Nack\FileParser\Strategy\Csv\CsvColumnarStrategy;
use Nack\FileParser\Strategy\Csv\CsvRowsStrategy;
use Nack\FileParser\Strategy\Csv\CsvStrategy;

/**
 * Interface describes methods for each of the buildable strategy classes.
 */
interface StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvStrategy.
     *
     * @param array $options
     * @return CsvStrategy
     */
    public function createCsvStrategy(array $options);

    /**
     * Creates a new instance of CsvColumnarStrategy.
     *
     * @param array $options
     * @return CsvColumnarStrategy
     */
    public function createCsvColumnarStrategy(array $options);

    /**
     * Creates a new instance of CsvRowsStrategy.
     *
     * @param array $options
     * @return CsvRowsStrategy
     */
    public function createCsvRowsStrategy(array $options);

    /**
     * Creates a new instance of IniStrategy.
     *
     * @return IniStrategy
     */
    public function createIniStrategy();

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
