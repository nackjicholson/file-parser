### Usage:

*foobar.yml*

```yaml
foo: bar
```

*foobar.json*

```json
{
    "foo": "bar"
}
```

```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();
$fromYaml = $fileParser->yaml('foobar.yml');
$fromJson = $fileParser->json('foobar.json');

echo "Array from yaml file:" . PHP_EOL;
print_r($fromYaml);
echo PHP_EOL;

echo "Array from json file:" . PHP_EOL;
print_r($fromJson);
echo PHP_EOL;
```

Outputs:

```
Array from yaml file:
Array
(
    [foo] => bar
)

Array from json file:
Array
(
    [foo] => bar
)
```
