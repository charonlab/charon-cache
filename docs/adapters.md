# Adapters

## APCu Adapter

The APCu adapter requires a APCu extension.

```php
$pool = new \Charon\Cache\Adapter\APCu\APCuAdapter(

);
```

## Array Adapter

The Array adapter is useful for testing purposes, as its data stored in memory.

```php
$pool = new \Charon\Cache\Adapter\Array\ArrayAdapter(

);
```
