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
     * Takes into account the first row of a csv file as column headers,
     * and attaches each column header to its associated row value.
     *
     * Csv file content:
     *
     * Col1,Col2
     * Row1Col1,Row1Col2
     * .
     * .
     * .
     *
     * Becomes:
     *
     * [
     *   [ 'Col1' => 'Row1Col1', 'Col2' => 'Row1Col2' ]
     *   .
     *   .
     *   .
     * ]
     *
     * @param mixed $file The file path of the file to parse.
     *
     * @return array The php array representation of the csv content of the file.
     */
    public function csvColumnar($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createCsvColumnarStrategy();
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a json file into a php array.
     *
     * @param mixed $file The file path of the file to parse.
     *
     * @return array The php array representation of the json content of the file.
     */
    public function json($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createJsonStrategy();
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a yaml file into a php array.
     *
     * @param mixed $file The file path of the file to parse.
     *
     * @return array The php array representation of the yaml content of the file.
     */
    public function yaml($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createYamlStrategy();
        return $strategy->parse($file);
    }

    /**
     * Ensures that the argument is, or is converted into an SplFileObject.
     * This method allows the public methods in this class to accept a string file path,
     * a SplFileInfo instance, or a SplFileObject and have them all resolve to
     * an SplFileObject to send to the strategy for parsing.
     *
     * @param mixed $file
     * @return \SplFileObject
     */
    private function ensureSplFileObject($file)
    {
        if ($file instanceof \SplFileObject) {
            return $file;
        }

        if ($file instanceof \SplFileInfo) {
            return $file->openFile();
        }

        return $this->splFileObjectFactory->create($file);
    }
}
