<?php

namespace Nack\FileParser\Strategy;

use Nack\FileParser\FileSystem\GetFileContentsTrait;

/**
 * Strategy for parsing json content.
 */
class JsonStrategy implements StrategyInterface
{
    use GetFileContentsTrait;

    /**
     * Parses a string of data into a php array.
     *
     * @param \SplFileObject $file
     *
     * @return array
     */
    public function parse(\SplFileObject $file)
    {
        $content = $this->getFileContents($file);
        return json_decode($content, true);
    }
}
