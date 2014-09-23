<?php

namespace Nack\FileParser\FileSystem;

/**
 * The interface which defines the required behavior for file factories -- objects that create useful representations
 * of files based on paths.
 */
interface FileFactoryInterface
{
    /**
     * Creates an object representing the file at the given path. The file will be opened in the specified mode.
     *
     * @param string $path The path to the file
     * @param string $mode The mode in which the file should be opened (defaults to 'r' for read only)
     * @return object An object representing the open file
     */
    public function create($path, $mode = 'r');
}
