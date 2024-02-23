# Usage

This following example shows basic usage of the cache:
```php

$value = $cache->get('foobar', function (\Charon\Cache\CacheItemPool $item): string {
    // The callback will be called only when the cache miss.
    return 'cachepool';
});

// Output: 'cachepool'
echo $value;

// Clears the cache value.
$cache->delete('foobar');
```
