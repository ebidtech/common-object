<?php

/**
 * LICENSE: [EMAILBIDDING_DESCRIPTION_LICENSE_HERE]
 *
 * @author     Diogo Rocha <diogo.rocha@emailbidding.com>
 * @copyright  2012-2014 Emailbidding
 * @license    [EMAILBIDDING_URL_LICENSE_HERE]
 */

namespace EBT\CommonObject\Tests\ApprovalIdsExceptions;

use EBT\CommonObject\ApprovalIdsExceptions\ApprovalIdsExceptions;
use EBT\CommonObject\Tests\TestCase;

class ApprovalIdsExceptionsTest extends TestCase
{
    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testInvalidApprovedArray()
    {
        new ApprovalIdsExceptions(array(1 ,'a'), array(2));
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testInvalidRejectedArray()
    {
        new ApprovalIdsExceptions(array(1), array(-1));
    }

    /**
     * @expectedException \EBT\CommonObject\Exception\InvalidArgumentException
     */
    public function testIntersectApprovedRejected()
    {
        new ApprovalIdsExceptions(array(1, 2, 3), array(4, 3, 5, 8));
    }

    public function testValidEmpty()
    {
        $emptyApprovals = new ApprovalIdsExceptions(array(), array());

        $this->assertEquals(array(), $emptyApprovals->getApproved());

        $this->assertEquals(array(), $emptyApprovals->getRejected());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => array(), ApprovalIdsExceptions::REJECTED => array()),
            $emptyApprovals->toArray()
        );
    }

    public function testValid()
    {
        $approved = array(1, 2);
        $rejected = array(3, 5);

        $emptyApprovals = new ApprovalIdsExceptions($approved, $rejected);

        $this->assertEquals($approved, $emptyApprovals->getApproved());

        $this->assertEquals($rejected, $emptyApprovals->getRejected());

        $this->assertEquals(
            array(ApprovalIdsExceptions::APPROVED => $approved, ApprovalIdsExceptions::REJECTED => $rejected),
            $emptyApprovals->toArray()
        );
    }
}
