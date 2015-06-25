<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2014 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\Tests\ApprovalIdsExceptions;

use EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions;
use EBT\CommonObject\Id\Id;
use EBT\CommonObject\Id\IdSet;
use EBT\CommonObject\Id\IdSetFactory;
use EBT\CommonObject\Tests\TestCase;

class ApprovalIdsExceptionsTest extends TestCase
{
    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::__construct()
     *
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testIntersectApprovedRejected()
    {
        new ApprovalIdsExceptions(
            new IdSet(array(new Id(1), new Id(2), new Id(3))),
            new IdSet(array(new Id(4), new Id(3), new Id(5), new Id(8)))
        );
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::__construct()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::getApproved()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::getRejected()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::toArray()
     */
    public function testValidEmpty()
    {
        $emptyApprovals = new ApprovalIdsExceptions(new IdSet(array()), new IdSet(array()));

        $this->assertEquals(array(), $emptyApprovals->getApproved()->toArray());

        $this->assertEquals(array(), $emptyApprovals->getRejected()->toArray());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => array(), ApprovalIdsExceptions::REJECTED => array()),
            $emptyApprovals->toArray()
        );
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::__construct()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::getApproved()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::getRejected()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::toArray()
     */
    public function testValid()
    {
        $approved = array(1, 2);
        $rejected = array(3, 5);

        $approvalIdsExceptions = new ApprovalIdsExceptions(
            IdSetFactory::fromArray($approved),
            IdSetFactory::fromArray($rejected)
        );

        $this->assertEquals($approved, $approvalIdsExceptions->getApproved()->toArray());

        $this->assertEquals($rejected, $approvalIdsExceptions->getRejected()->toArray());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => $approved, ApprovalIdsExceptions::REJECTED => $rejected),
            $approvalIdsExceptions->toArray()
        );
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::isIdApproved()
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions::isIdRejected()
     */
    public function testIsIdApprovedIsIdRejected()
    {
        $approved = array(1, 2);
        $rejected = array(3, 5);

        $approvalIdsExceptions = new ApprovalIdsExceptions(
            IdSetFactory::fromArray($approved),
            IdSetFactory::fromArray($rejected)
        );

        $this->assertTrue($approvalIdsExceptions->isIdApproved(1));
        $this->assertFalse($approvalIdsExceptions->isIdApproved(3));

        $this->assertTrue($approvalIdsExceptions->isIdRejected(5));
        $this->assertFalse($approvalIdsExceptions->isIdRejected(2));
    }
}
