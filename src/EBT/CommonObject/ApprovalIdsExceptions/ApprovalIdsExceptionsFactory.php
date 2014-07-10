<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2014 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\ApprovalIdsExceptions;

abstract class ApprovalIdsExceptionsFactory
{
    /**
     * @return ApprovalIdsExceptions
     */
    public static function createEmpty()
    {
        return static::create(array(), array());
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

        return static::create($approvedIds, $rejectedIds);
    }

    /**
     * @param int[] $approved
     * @param int[] $rejected
     *
     * @return ApprovalIdsExceptions
     */
    public static function create(array $approved, array $rejected)
    {
        return new ApprovalIdsExceptions($approved, $rejected);
    }
}
