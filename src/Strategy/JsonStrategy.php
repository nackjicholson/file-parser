<?php

namespace Nack\FileParser\Strategy;

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
