<?php

namespace Nack\FileParser\Strategy;

/**
 * Strategy for parsing json content.
 */
class CsvStrategy implements StrategyInterface
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
        $result = [];

        $header = $file->fgetcsv();

        while (!$file->eof()) {
            $row = $file->fgetcsv();

            // If row is not a blank line.
            if ($row[0]) {
                $result[] = array_combine($header, $row);
            }
        }

        return $result;
    }
}
