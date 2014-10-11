<?php

namespace Nack\FileParser\Strategy\Csv;

/**
 * * Strategy for parsing csv content, row based.
 */
class CsvRowsStrategy extends AbstractCsvLineStrategy
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
    protected function formatLine(array &$result, $line)
    {
        $key = array_shift($line);

        // Skips null line, or lines with null keys.
        if (empty($key)) {
            return;
        }

        // Line has one value, key is set as the value.
        if (count($line) === 1) {
            $result[$key] = $line[0];
            return;
        }

        // Otherwise, key is set to the array of remaining values.
        $result[$key] = $line;
    }
}
