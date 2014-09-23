<?php

namespace Nack\FileParser\FileSystem;

/**
 * Provides method for getting the contents of an SplFileObject
 */
trait GetFileContentsTrait
{
    /**
     * Returns the content of a file as a string.
     *
     * @param \SplFileObject $file
     *
     * @return string
     */
    protected function getFileContents(\SplFileObject $file)
    {
        $content = '';
        foreach ($file as $line) {
            $content .= $line;
        }

        return $content;
    }
}
