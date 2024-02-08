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

use Psr\Cache\CacheItemInterface;

final class CacheItem implements CacheItemInterface
{
    public function __construct(
        private readonly string $key,
        private readonly bool   $isHit = false,
        private mixed           $value = null,
        private null|int|float  $expiry = null
    ) {
    }

    /**
     * @inheritDoc
     */
    public function getKey(): string {
        return $this->key;
    }

    /**
     * @inheritDoc
     */
    public function get(): mixed {
        return $this->value;
    }

    /**
     * @inheritDoc
     */
    public function isHit(): bool {
        return $this->isHit;
    }

    /**
     * @inheritDoc
     */
    public function set(mixed $value): static {
        $this->value = $value;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function expiresAt(?\DateTimeInterface $expiration): static {
        $this->expiry = null !== $expiration ? (float) $expiration->format('U.u') : null;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function expiresAfter(\DateInterval|int|null $time): static {
        if ($time instanceof \DateInterval) {
            if (($datetime = \DateTimeImmutable::createFromFormat('U', '0')) !== false) {
                $this->expiry = \microtime(true) + (float) $datetime->add($time)->format('U.u');
            }
        } else {
            $this->expiry = match (true) {
                \is_null($time) => null,
                default => $time + \microtime(true)
            };
        }

        return $this;
    }

    /**
     * Returns expiration time.
     *
     * @return null|int|float
     */
    public function getExpirationTime(): float|int|null {
        return $this->expiry;
    }
}
