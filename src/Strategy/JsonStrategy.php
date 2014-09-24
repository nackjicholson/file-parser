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
     * Parses a file of data into a php array.
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
