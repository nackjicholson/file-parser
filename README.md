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

```php
<?php

require_once '../vendor/autoload.php';

$fileParser = new \Nack\FileParser\FileParser();

print_r($fileParser->yaml('myfile.yml'));
print_r($fileParser->json('bagel.json'));
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
