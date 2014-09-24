<?php

namespace Nack\FileParser\Strategy;

/**
 * * Strategy for parsing csv content, row based.
 */
class CsvRowsStrategy implements StrategyInterface
{
    /**
     * Parses a file of data into a php array.
     *
     * @param \SplFileObject $file
     *
     * @return array
     */
    public function parse(\SplFileObject $file)
    {
        $result = [];

        while (!$file->eof()) {
            $row = $file->fgetcsv();

            $key = array_shift($row);

            // Skips null rows, or rows with null keys.
            if (empty($key)) {
                continue;
            }

            // Row has one value, key is set as the value.
            if (count($row) === 1) {
                $result[$key] = $row[0];
                continue;
            }

            // key is set to the array of remaining values.
            $result[$key] = $row;
        }

        return $result;
    }
}
