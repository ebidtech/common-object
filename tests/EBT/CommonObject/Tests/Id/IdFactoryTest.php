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
use EBT\CommonObject\Id\IdFactory;

/**
 * IdFactoryTest
 */
class IdFactoryTest extends TestCase
{
    public function testCreate()
    {
        $this->assertEquals(12112, IdFactory::create('12112')->get());
        $this->assertEquals(20300, IdFactory::create(20300)->get());
        $this->assertEquals(100, IdFactory::create('0100')->get());
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testCreateReal()
    {
        IdFactory::create(10.0);
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testStringReal()
    {
        IdFactory::create('10.5');
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testCreateClassNoToString()
    {
        IdFactory::create(new \stdClass());
    }

    public function testCreateClassToString()
    {
        $this->assertEquals(10, IdFactory::create(new TestId(10))->get());
    }
}
