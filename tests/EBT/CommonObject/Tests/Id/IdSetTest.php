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
use EBT\CommonObject\Id\IdSet;
use EBT\CommonObject\Id\Id;

/**
 * IdSetTest
 */
class IdSetTest extends TestCase
{
    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testAddDuplicate()
    {
        new IdSet(
            array(
                new Id(1),
                new Id(1)
            )
        );
    }

    public function testIterable()
    {
        $ids = new IdSet(
            array(
                new Id(1),
                new Id(2)
            )
        );

        $this->assertCount(2, $ids);
        $idVal = 1;
        /** @var Id $id */
        foreach ($ids as $id) {
            $this->assertEquals($idVal, $id->get());
            ++$idVal;
        }
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testCustomIdAddDuplicate()
    {
        new TestIdSet(
            array(
                new TestId(10),
                new TestId(10)
            )
        );
    }

    public function testCustomIdIterable()
    {
        $ids = new TestIdSet(
            array(
                new TestId(1),
                new TestId(2)
            )
        );

        $this->assertCount(2, $ids);
        $idVal = 1;
        /** @var Id $id */
        foreach ($ids as $id) {
            $this->assertEquals($idVal, $id->get());
            ++$idVal;
        }
    }

    public function testToArray()
    {
        $ids = new TestIdSet(
            array(
                new TestId(10),
                new TestId(50),
                new TestId(80)
            )
        );

        $this->assertEquals(array(10, 50, 80), $ids->toArray());
    }

    public function testToString()
    {
        $ids = new TestIdSet(
            array(
                new TestId(10),
                new TestId(50),
                new TestId(80)
            )
        );

        $this->assertEquals('10,50,80', (string) $ids);
    }

    /**
     * @covers EBT\CommonObject\Id\IdSet::intersects
     */
    public function testIntersects()
    {
        $idSet1 = new IdSet(array(new Id(2), new Id(4), new Id(5)));
        $idSet2 = new IdSet(array(new Id(3), new Id(7)));
        $idSet3 = new IdSet(array(new Id(2), new Id(8)));

        $this->assertFalse($idSet1->intersects($idSet2));
        $this->assertTrue($idSet1->intersects($idSet3));
        $this->assertFalse($idSet2->intersects($idSet3));
    }
}
