<?php

namespace Nack\FileParser\Strategy;

/**
 * Base for strategies which perform formatting on each line of a file to generate final result.
 */
abstract class AbstractLineStrategy extends AbstractStrategy
{
    /**
     * Formats a line from a file and adds it to the result.
     * The result is passed by reference.
     *
     * @param array $result The result of running the strategy, passed in by reference.
     * @param mixed $line Line of file data.
     *
     * @return void
     */
    abstract protected function formatLine(array &$result, $line);
}
