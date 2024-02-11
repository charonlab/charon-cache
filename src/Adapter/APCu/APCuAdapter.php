<?php

/*
 * This file is part of the charonlab/charon-cache.
 *
 * Copyright (C) 2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Cache\Adapter\APCu;

use Charon\Cache\Adapter\GenericAdapter;
use Charon\Cache\CacheItem;
use Charon\Cache\Exception\CacheException;

class APCuAdapter extends GenericAdapter
{
    public function __construct() {
        if (!\extension_loaded('apcu')) {
            throw new CacheException('APCu extension is not loaded');
        }

        parent::__construct();
    }

    /**
     * @inheritDoc
     */
    protected function doSave(CacheItem $item): array|bool
    {
        $entry = [
            'data' => $item->get(),
            'ttl' => $item->getExpirationTime()
        ];

        return \apcu_store(
            $item->getKey(),
            \serialize($entry),
            (int) $item->getExpirationTime()
        );
    }

    /**
     * @inheritDoc
     */
    protected function doFetch(array $keys): iterable
    {
        $ok = false;
        $values = [];

        $results = \apcu_fetch($keys, $ok);

        if (!\is_array($results)) {
            $results = [$results];
        }

        foreach ($results as $key => $result) {
            if ($ok && $result !== null) {
                $entry = \unserialize($result);
                $values[$key] = $entry['data'];
            }
        }

        return $values;

    }

    /**
     * @inheritDoc
     */
    protected function doDelete(array $keys): bool
    {
        return (bool) \apcu_delete($keys);
    }

    /**
     * @inheritDoc
     */
    protected function doHave(string $key): bool
    {
        return \apcu_exists($key);
    }

    /**
     * @inheritDoc
     */
    protected function doClear(): bool
    {
        return \apcu_clear_cache();
    }
}
