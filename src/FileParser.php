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
     * Parses the contents of a yaml file into a php array.
     *
     * @param string $path The file path of the file to parse.
     *
     * @return array The php array representation of the yaml content of the file.
     */
    public function yaml($path)
    {
        $file = $this->splFileObjectFactory->create($path);

        // todo, this in private method.
        $content = '';
        foreach ($file as $line) {
            $content .= $line;
        }

        $strategy = $this->strategyFactory->createYamlStrategy();

        return $strategy->parse($content);
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
}
