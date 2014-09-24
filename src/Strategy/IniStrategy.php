<?php

namespace Nack\FileParser\Strategy;

/**
 * Strategy for parsing .ini file content.
 */
class IniStrategy implements StrategyInterface
{
    /**
     * Parses a string of data into a php array.
     *
     * @param \SplFileObject $file
     *
     * @return array
     */
    public function parse(\SplFileObject $file)
    {
        return parse_ini_file($file->getPathname());
    }
}
