<?php

namespace Nack\FileParser\FileSystem;

/**
 * A factory class to abstract the creation of SPL file object instances from paths.
 */
class SplFileObjectFactory implements FileFactoryInterface
{
    /**
     * Creates a new SplFileObject instance with the given path. By default, the underlying file will be opened in
     * read mode.
     *
     * @param string $path The path to the file to open
     * @param string $mode The mode in which to open the file
     *
     * @return \SplFileObject An SPL file object instance representing the specified file, opened in the given mode
     */
    public function create($path, $mode = 'r')
    {
        $splFileObject = new \SplFileObject($path, $mode);

        return $splFileObject;
    }
}
