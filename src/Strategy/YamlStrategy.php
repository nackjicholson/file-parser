<?php

namespace Nack\FileParser\Strategy;

use Symfony\Component\Yaml\Parser;

/**
 * Strategy for parsing yaml content.
 */
class YamlStrategy implements StrategyInterface
{
    /** @var Parser */
    private $parser;

    public function __construct(Parser $parser)
    {
        $this->parser = $parser;
    }

    /**
     * Parses a string of data into a php array.
     *
     * @param string $content
     *
     * @return array
     */
    public function parse($content)
    {
        return $this->parser->parse($content);
    }
}
