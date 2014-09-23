<?php

namespace Nack\FileParser\Strategy;

/**
 * Strategy for parsing json content.
 */
class JsonStrategy implements StrategyInterface
{
    /**
     * Parses a string of data into a php array.
     *
     * @param string $content
     *
     * @return array
     */
    public function parse($content)
    {
        return json_decode($content, true);
    }
}
