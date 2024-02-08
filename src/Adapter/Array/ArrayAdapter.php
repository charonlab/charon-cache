<?php

/*
 * This file is part of the charonlab/charon-cache.
 *
 * Copyright (C) 2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Cache\Adapter\Array;

use Charon\Cache\Adapter\GenericAdapter;
use Charon\Cache\CacheItem;

use function array_key_exists;

final class ArrayAdapter extends GenericAdapter
{
    /** @var CacheItem[] $values */
    private array $values = [];

    /**
     * @inheritDoc
     */
    protected function doFetch(array $keys): iterable {
        $values = [];

        foreach ($keys as $key) {
            if (array_key_exists($key, $this->values)) {
                $values[$key] = $this->values[$key];
            }
        }

        return $values;
    }

    /**
     * @inheritDoc
     */
    protected function doDelete(array $keys): bool {
        foreach ($keys as $key) {
            unset($this->values[$key]);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function doClear(): bool {
        $this->values = [];

        return true;
    }

    /**
     * @inheritDoc
     */
    protected function doHave(string $key): bool {
        return array_key_exists($key, $this->values);
    }

    /**
     * @inheritDoc
     */
    protected function doSave(CacheItem $item): bool {
        $this->values[$item->getKey()] = $item;

        return true;
    }
}
