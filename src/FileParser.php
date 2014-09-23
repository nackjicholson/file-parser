<?php

namespace Nack\FileParser;

use Cascade\FileSystem\SplFileObjectFactory;
use Nack\FileParser\Strategy\StrategyFactory;

/**
 * Parses the data content of a file into a php array.
 */
class FileParser
{
    /** @var SplFileObjectFactory */
    private $splFileObjectFactory;

    /** @var StrategyFactory */
    private $strategyFactory;

    /**
     * @param SplFileObjectFactory $fileFactory
     */
    public function setSplFileObjectFactory(SplFileObjectFactory $fileFactory)
    {
        $this->splFileObjectFactory = $fileFactory;
    }

    /**
     * @param StrategyFactory $strategyFactory
     */
    public function setStrategyFactory(StrategyFactory $strategyFactory)
    {
        $this->strategyFactory = $strategyFactory;
    }

    /**
     * Initializes default factory classes.
     */
    public function __construct()
    {
        $this->splFileObjectFactory = $this->getDefaultSplFileObjectFactory();
        $this->strategyFactory = $this->getDefaultStrategyFactory();
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
        $strategy = $this->strategyFactory->createJsonStrategy();

        return $strategy->parse($this->getFileContent($path));
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
        $strategy = $this->strategyFactory->createYamlStrategy();

        return $strategy->parse($this->getFileContent($path));
    }

    /**
     * Provides a SplFileObjectFactory.
     *
     * @return SplFileObjectFactory
     */
    private function getDefaultSplFileObjectFactory()
    {
        return new SplFileObjectFactory();
    }

    /**
     * Provides a StrategyFactory
     *
     * @return StrategyFactory
     */
    private function getDefaultStrategyFactory()
    {
        return new StrategyFactory();
    }

    /**
     * Extracts the contents of the file at the given path.
     *
     * @param string $path A file path.
     *
     * @return string The contents of the file.
     */
    private function getFileContent($path)
    {
        $file = $this->splFileObjectFactory->create($path);

        $content = '';
        foreach ($file as $line) {
            $content .= $line;
        }

        return $content;
    }
}
