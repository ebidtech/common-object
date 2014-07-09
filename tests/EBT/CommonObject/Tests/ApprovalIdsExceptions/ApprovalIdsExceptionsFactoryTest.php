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
use EBT\CommonObject\Tests\TestCase;

class ApprovalIdsExceptionsFactoryTest extends TestCase
{
    public function testCreateEmpty()
    {
        $emptyApprovals = ApprovalIdsExceptionsFactory::createEmpty();

        $this->assertEquals(array(), $emptyApprovals->getApproved());

        $this->assertEquals(array(), $emptyApprovals->getRejected());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => array(), ApprovalIdsExceptions::REJECTED => array()),
            $emptyApprovals->toArray()
        );
    }

    public function testFromArray()
    {
        $approved = array(1, 2);
        $rejected = array(3);
        $approvalsArray = array(
            ApprovalIdsExceptions::APPROVED => $approved,
            ApprovalIdsExceptions::REJECTED => $rejected
        );

        $approvals = ApprovalIdsExceptionsFactory::fromArray($approvalsArray);

        $this->assertEquals($approved, $approvals->getApproved());

        $this->assertEquals($rejected, $approvals->getRejected());

        $this->assertEquals($approvalsArray, $approvals->toArray());
    }
}
