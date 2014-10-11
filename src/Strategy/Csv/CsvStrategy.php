<?php

namespace Nack\FileParser\Strategy\Csv;

class CsvStrategy extends AbstractCsvLineStrategy
{
    /**
     * Formats a line from a file and adds it to the result.
     * The result is passed by reference.
     *
     * @param array $result The result of running the strategy, passed in by reference.
     * @param array $line Line of file data.
     *
     * @return void
     */
    protected function formatLine(array &$result, $line)
    {
        $result[] = $line;
    }
}
