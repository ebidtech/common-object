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
}
