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
use EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptionsFactory;
use EBT\CommonObject\Id\IdSetFactory;
use EBT\CommonObject\Tests\TestCase;

class ApprovalIdsExceptionsFactoryTest extends TestCase
{
    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptionsFactory::createEmpty()
     */
    public function testCreateEmpty()
    {
        $emptyApprovals = ApprovalIdsExceptionsFactory::createEmpty();

        $this->assertEquals(array(), $emptyApprovals->getApproved()->toArray());

        $this->assertEquals(array(), $emptyApprovals->getRejected()->toArray());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => array(), ApprovalIdsExceptions::REJECTED => array()),
            $emptyApprovals->toArray()
        );
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptionsFactory::fromIdSets()
     */
    public function testFromIdSets()
    {
        $approved = array(1, 2);
        $rejected = array(3);

        $approvals = ApprovalIdsExceptionsFactory::fromIdSets(
            IdSetFactory::fromArray($approved),
            IdSetFactory::fromArray($rejected)
        );

        $this->assertEquals($approved, $approvals->getApproved()->toArray());

        $this->assertEquals($rejected, $approvals->getRejected()->toArray());
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptionsFactory::create()
     */
    public function testCreate()
    {
        $approved = array(1, 2);
        $rejected = array(3);

        $approvals = ApprovalIdsExceptionsFactory::create($approved, $rejected);

        $this->assertEquals($approved, $approvals->getApproved()->toArray());

        $this->assertEquals($rejected, $approvals->getRejected()->toArray());
    }

    /**
     * @covers EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptionsFactory::fromArray()
     */
    public function testFromArray()
    {
        $approved = array(1, 2);
        $rejected = array(3);

        $approvalsArray = array(
            ApprovalIdsExceptions::APPROVED => $approved,
            ApprovalIdsExceptions::REJECTED => $rejected
        );

        $approvals = ApprovalIdsExceptionsFactory::fromArray($approvalsArray);

        $this->assertEquals($approved, $approvals->getApproved()->toArray());

        $this->assertEquals($rejected, $approvals->getRejected()->toArray());

        $this->assertEquals($approvalsArray, $approvals->toArray());
    }
}
