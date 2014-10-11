<?php

namespace Nack\FileParser\Strategy;

use Nack\FileParser\Strategy\Csv\CsvColumnarStrategy;
use Nack\FileParser\Strategy\Csv\CsvRowsStrategy;
use Nack\FileParser\Strategy\Csv\CsvStrategy;
use Symfony\Component\Yaml\Parser;

/**
 * Creates parsing strategies, instances of StrategyInterface.
 */
class StrategyFactory implements StrategyFactoryInterface
{
    /**
     * Creates a new instance of CsvStrategy.
     *
     * @param array $options
     * @return CsvStrategy
     */
    public function createCsvStrategy(array $options)
    {
        $strategy = new CsvStrategy();
        $strategy->setOptions($options);

        return $strategy;
    }

    /**
     * Creates a new instance of CsvColumnarStrategy.
     *
     * @param array $options
     * @return CsvColumnarStrategy
     */
    public function createCsvColumnarStrategy(array $options)
    {
        $strategy = new CsvColumnarStrategy();
        $strategy->setOptions($options);

        return $strategy;
    }

    /**
     * Creates a new instance of CsvRowsStrategy.
     *
     * @param array $options
     * @return CsvRowsStrategy
     */
    public function createCsvRowsStrategy(array $options)
    {
        $strategy = new CsvRowsStrategy();
        $strategy->setOptions($options);

        return $strategy;
    }

    /**
     * Creates a new instance of IniStrategy.
     *
     * @return IniStrategy
     */
    public function createIniStrategy()
    {
        return new IniStrategy();
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
