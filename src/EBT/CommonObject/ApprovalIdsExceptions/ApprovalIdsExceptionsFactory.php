<?php

/**
 * LICENSE: [EMAILBIDDING_DESCRIPTION_LICENSE_HERE]
 *
 * @author     Diogo Rocha <diogo.rocha@emailbidding.com>
 * @copyright  2012-2014 Emailbidding
 * @license    [EMAILBIDDING_URL_LICENSE_HERE]
 */

namespace EBT\CommonObject\ApprovalIdsExceptions;

abstract class ApprovalIdsExceptionsFactory
{
    /**
     * @return ApprovalIdsExceptions
     */
    public static function createEmpty()
    {
        return new ApprovalIdsExceptions(array(), array());
    }

    /**
     * @param array $approvalsArr
     *
     * @return ApprovalIdsExceptions
     */
    public static function fromArray($approvalsArr)
    {
        $approvedIds = $approvalsArr[ApprovalIdsExceptions::APPROVED];
        $rejectedIds = $approvalsArr[ApprovalIdsExceptions::REJECTED];

        return new ApprovalIdsExceptions($approvedIds, $rejectedIds);
    }
}
