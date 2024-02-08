<?php

/*
 * This file is part of the charonlab/charon-cache.
 *
 * Copyright (C) 2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Cache;

use Psr\Cache\CacheItemPoolInterface;

interface CacheItemPool extends CacheItemPoolInterface
{
    /**
     * Fetches a value from the cache.
     *
     * @template T
     *
     * @param string $key
     *  The key of item to gets from cache.
     * @param null|(callable(\Psr\Cache\CacheItemInterface,bool):T) $callback
     *  On cache misses, a callback is called that should return missing value.
     *
     * @return T
     */
    public function get(string $key, ?callable $callback = null): mixed;

    /**
     * Persists data in the cache, uniquely referenced by a key with an optional expiration TTL time.
     *
     * @param string $key
     *  The key of the item to store.
     * @param mixed $value
     *  The value of the item to store, must be serializable.
     * @param null|int|\DateInterval $tls
     *  The TTL value of this item.
     *
     * @return bool
     *  True on success, otherwise false.
     */
    public function set(string $key, mixed $value, null|int|\DateInterval $tls = null): bool;

    /**
     * Removes an item from cache.
     *
     * @param string $key
     *  The key of item to removes from cache.
     *
     * @return bool
     *  Returns `TRUE` if the was successfully removed, otherwise `FALSE`.
     */
    public function delete(string $key): bool;
}
