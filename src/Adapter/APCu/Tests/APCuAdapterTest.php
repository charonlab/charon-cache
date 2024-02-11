<?php

/*
 * This file is part of the charonlab/charon-cache.
 *
 * Copyright (C) 2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Cache\Adapter\APCu\Tests;

use Charon\Cache\Adapter\APCu\APCuAdapter;
use Charon\Cache\CacheItem;
use Charon\Cache\Exception\CacheException;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[Group('unit')]
#[CoversClass(APCuAdapter::class)]
class APCuAdapterTest extends TestCase
{
    public function testThrowsExceptionIfAPCuExtensionIsNotLoaded(): void {
        self::expectException(CacheException::class);
        self::expectExceptionMessage('APCu extension is not loaded');

        new APCuAdapter();
    }

    public function testSerialization(): void {
        $mock = $this->createMock(APCuAdapter::class);
        $mock->method('get')
            ->willReturn(new CacheItem('foo', true, 'bar'));

        $mock->set('foo', 'bar');

        self::assertEquals(
            'bar',
            $mock->get('foo')->get()
        );
    }
}
