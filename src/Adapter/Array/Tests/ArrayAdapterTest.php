<?php

/*
 * This file is part of the charonlab/charon-cache.
 *
 * Copyright (C) 2024 Charon Lab Development Team
 *
 * This software may be modified and distributed under the terms
 * of the MIT license. See the LICENSE.md file for details.
 */

namespace Charon\Cache\Adapter\Array\Tests;

use Charon\Cache\Adapter\Array\ArrayAdapter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Group;
use PHPUnit\Framework\TestCase;

#[CoversClass(ArrayAdapter::class)]
#[Group('unit')]
class ArrayAdapterTest extends TestCase
{
    public function testDoFetch(): void {
        $adapter = new ArrayAdapter();
        $adapter->set('foo', 'bar');

        $this->assertEquals(
            'bar',
            $adapter->get('foo')->get()
        );
    }
}
