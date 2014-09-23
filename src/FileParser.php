<?php

namespace Nack\FileParser;

use Nack\FileParser\FileSystem\SplFileObjectFactory;
use Nack\FileParser\Strategy\StrategyFactory;
use Nack\FileParser\Strategy\StrategyFactoryInterface;

/**
 * Parses the data content of a file into a php array.
 */
class FileParser
{
    /** @var SplFileObjectFactory */
    private $splFileObjectFactory;

    /** @var StrategyFactoryInterface */
    private $strategyFactory;

    /**
     * Sets or initializes default factory classes.
     *
     * @param SplFileObjectFactory $splFileObjectFactory
     * @param StrategyFactoryInterface $strategyFactory
     */
    public function __construct(
        SplFileObjectFactory $splFileObjectFactory = null,
        StrategyFactoryInterface $strategyFactory = null
    ) {
        $this->splFileObjectFactory = isset($splFileObjectFactory) ? $splFileObjectFactory : new SplFileObjectFactory();
        $this->strategyFactory = isset($strategyFactory) ? $strategyFactory : new StrategyFactory();
    }

    /**
     * Parses the contents of a csv file into a php array.
     *
     * @param string $path The file path of the file to parse.
     *
     * @return array The php array representation of the csv content of the file.
     */
    public function csv($path)
    {
        $file = $this->splFileObjectFactory->create($path);
        $strategy = $this->strategyFactory->createCsvStrategy();

        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a json file into a php array.
     *
     * @param string $path The file path of the file to parse.
     *
     * @return array The php array representation of the json content of the file.
     */
    public function json($path)
    {
        $file = $this->splFileObjectFactory->create($path);
        $strategy = $this->strategyFactory->createJsonStrategy();

        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a yaml file into a php array.
     *
     * @param string $path The file path of the file to parse.
     *
     * @return array The php array representation of the yaml content of the file.
     */
    public function yaml($path)
    {
        $file = $this->splFileObjectFactory->create($path);
        $strategy = $this->strategyFactory->createYamlStrategy();

        return $strategy->parse($file);
    }
}
