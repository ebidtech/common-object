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
use EBT\CommonObject\Id\Id;

/**
 * IdTest
 */
class IdTest extends TestCase
{
    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testString()
    {
        new Id('t');
    }

    public function testValid()
    {
        $id = new Id(10);
        $this->assertEquals(10, $id->get());
        $this->assertEquals('10', (string) $id);
    }

    public function testEquals()
    {
        $id1 = new Id(10);
        $id2 = new Id(20);
        $id3 = new Id(10);

        $this->assertTrue($id1->equals($id3));
        $this->assertFalse($id1->equals($id2));
    }
}
