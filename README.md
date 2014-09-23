## Example:

*foobar.yml*
```yaml
foo: bar
```
*example.php*
```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('foobar.yml'));
```
Outputs:

```
Array
(
    [foo] => bar
)
```

## Install

Via [composer](http://getComposer.org)

`compser require nackjicholson/file-parser=~1.1`

or add too composer.json
```json
"require": {
    "nackjicholson/file-parser": "~1.1"
}
```

## CSV

```
foo,beep
bar,boop
```
```php
$fileParser->csv('foobar.csv');
/*
Array
(
    [0] => Array
        (
            [foo] => bar
            [beep] => boop
        )

)
*/
```

## JSON

```json
{
    "foo": "bar"
}
```
```php
$fileParser->json('foobar.json');
/*
Array
(
    [foo] => bar
)
*/
```

## YAML
```
foo: bar
```
```php
$fileParser->yaml('foobar.yaml');
/*
Array
(
    [foo] => bar
)
*/
```
