<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('foobar.yml'));
print_r($fileParser->json('foobar.json'));
print_r($fileParser->csv('foobar.csv'));
