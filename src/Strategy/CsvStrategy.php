<?php

namespace Nack\FileParser\Strategy;

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

        while (!$file->eof()) {
            $result[] = $file->fgetcsv();
        }

        return $result;
    }
}
