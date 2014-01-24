<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\Tests\Id;

use EBT\CommonObject\Tests\TestCase;
use EBT\CommonObject\Id\IdSetFactory;
use EBT\CommonObject\Id\Id;

/**
 * IdSetFactoryTest
 */
class IdSetFactoryTest extends TestCase
{
    public function testFromArray()
    {
        $idSet = IdSetFactory::fromArray(array(10, '30'));

        $this->assertCount(2, $idSet);
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testFromArrayInvalid()
    {
        IdSetFactory::fromArray(array(10, '30.66'));
    }

    public function testFromString()
    {
        $ids = IdSetFactory::fromString('2, 4,  8  ');
        $this->assertCount(3, $ids);

        $expectedId = 2;
        /** @var Id $id */
        foreach ($ids as $id) {
            $this->assertEquals($expectedId, $id->get());
            $expectedId *= 2;
        }
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testFromStringNotString()
    {
        IdSetFactory::fromString(array());
    }
}
