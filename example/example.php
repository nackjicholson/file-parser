<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

// yaml from a path.
print_r($fileParser->yaml('foobar.yml'));

// json from a file info object.
$fileInfo = new \SplFileInfo('foobar.json');
print_r($fileParser->json($fileInfo));

// csv from a file object.
$fileObject = new \SplFileObject('foobar.csv');
print_r($fileParser->csvColumns($fileObject));
