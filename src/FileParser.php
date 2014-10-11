<?php

namespace Nack\FileParser;

use Nack\FileParser\FileSystem\SplFileObjectFactory;
use Nack\FileParser\Strategy\StrategyFactory;
use Nack\FileParser\Strategy\StrategyFactoryInterface;

/**
 * Parses the data content of a file into a php array.
 */
class FileParser
{
    /** @var SplFileObjectFactory */
    private $splFileObjectFactory;

    /** @var StrategyFactoryInterface */
    private $strategyFactory;

    /**
     * Sets or initializes default factory classes.
     *
     * @param SplFileObjectFactory $splFileObjectFactory
     * @param StrategyFactoryInterface $strategyFactory
     */
    public function __construct(
        SplFileObjectFactory $splFileObjectFactory = null,
        StrategyFactoryInterface $strategyFactory = null
    ) {
        $this->splFileObjectFactory = isset($splFileObjectFactory) ? $splFileObjectFactory : new SplFileObjectFactory();
        $this->strategyFactory = isset($strategyFactory) ? $strategyFactory : new StrategyFactory();
    }

    /**
     * Parses the contents of a csv file into a php array.
     * Literal parse of every line as csv.
     *
     * Csv file content:
     *
     * Col1,Col2
     * Row1Col1,Row1Col2
     *
     * Becomes:
     *
     * [
     *   [ 'Col1', 'Col2' ],
     *   [ 'Row1Col1', 'Row1Col2' ]
     * ]
     *
     * @param mixed $file The file path of the file to parse.
     * @param array $options Hash of options, override default fgetcsv options here.
     *
     * @return array
     */
    public function csv($file, array $options = [])
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createCsvStrategy($options);
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a csv file into a php array.
     * Takes into account the first row of a csv file as column headers,
     * and attaches each column header to its associated row value.
     *
     * Csv file content:
     *
     * Col1,Col2
     * Row1Col1,Row1Col2
     *
     * Becomes:
     *
     * [
     *   [ 'Col1' => 'Row1Col1', 'Col2' => 'Row1Col2' ]
     * ]
     *
     * @param mixed $file The file path of the file to parse.
     * @param array $options Hash of options, override default fgetcsv options here.
     *
     * @return array
     */
    public function csvColumnar($file, array $options = [])
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createCsvColumnarStrategy($options);
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a csv file into a php array.
     * Row parsing uses the first item in each row as a key.
     * Rows with two items will be: key => value
     * Rows with more than two items will have the key set to an array of values: key => [ values... ]
     * It ignores lines which are null, or have a null first value.
     *
     * Csv file content:
     *
     * foo,bar
     * bingo,bango,bongo
     * null, bagel, cream, cheese
     *
     * Becomes:
     *
     * [
     *   'foo' => 'bar',
     *   'bingo' => [ 'bango', 'bongo' ]
     * ]
     *
     * @param mixed $file The file path of the file to parse.
     * @param array $options Hash of options, override default fgetcsv options here.
     *
     * @return array
     */
    public function csvRows($file, array $options = [])
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createCsvRowsStrategy($options);
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a ini file into a php array.
     *
     * @param mixed $file The file path, SplFileInfo, or SplFileObject
     *
     * @return array The php array representation of the ini content of the file.
     */
    public function ini($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createIniStrategy();
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a json file into a php array.
     *
     * @param mixed $file The file path, SplFileInfo, or SplFileObject
     *
     * @return array The php array representation of the json content of the file.
     */
    public function json($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createJsonStrategy();
        return $strategy->parse($file);
    }

    /**
     * Parses the contents of a yaml file into a php array.
     *
     * @param mixed $file The file path of the file to parse.
     *
     * @return array The php array representation of the yaml content of the file.
     */
    public function yaml($file)
    {
        $file = $this->ensureSplFileObject($file);
        $strategy = $this->strategyFactory->createYamlStrategy();
        return $strategy->parse($file);
    }

    /**
     * Ensures that the argument is, or is converted into an SplFileObject.
     * This method allows the public methods in this class to accept a string file path,
     * a SplFileInfo instance, or a SplFileObject and have them all resolve to
     * an SplFileObject to send to the strategy for parsing.
     *
     * @param mixed $file
     * @return \SplFileObject
     */
    private function ensureSplFileObject($file)
    {
        if ($file instanceof \SplFileObject) {
            return $file;
        }

        if ($file instanceof \SplFileInfo) {
            return $file->openFile();
        }

        return $this->splFileObjectFactory->create($file);
    }
}
