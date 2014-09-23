## Example:

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

*example.php*

```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('foobar.yml'));
print_r($fileParser->json('foobar.json'));
```

Outputs:

```
Array
(
    [foo] => bar
)
Array
(
    [foo] => bar
)
```
