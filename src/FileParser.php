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
     * @param mixed $file The file path of the file to parse.
     *
     * @return array The php array representation of the csv content of the file.
     */
    public function csv($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createCsvStrategy();
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
     * This method allows the methods of this class to accept a string file path,
     * a SplFileInfo instance, or a SplFileObject.
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
