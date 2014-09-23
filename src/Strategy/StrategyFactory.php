<?php

namespace Nack\FileParser\Strategy;

use Symfony\Component\Yaml\Parser;

/**
 * Creates parsing strategies, instances of StrategyInterface.
 */
class StrategyFactory
{
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
