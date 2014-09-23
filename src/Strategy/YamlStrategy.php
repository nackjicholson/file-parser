<?php

namespace Nack\FileParser\Strategy;

use Nack\FileParser\FileSystem\GetFileContentsTrait;
use Symfony\Component\Yaml\Parser;

/**
 * Strategy for parsing yaml content.
 */
class YamlStrategy implements StrategyInterface
{
    use GetFileContentsTrait;

    /** @var Parser */
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Parses a string of data into a php array.
     *
     * @param \SplFileObject $file
     *
     * @return array
     */
    public function parse(\SplFileObject $file)
    {
        $contents = $this->getFileContents($file);
        return $this->parser->parse($contents);
    }
}
