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

use EBT\CommonObject\Id\IdSet;
use EBT\CommonObject\Id\IdSetFactory;

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
     * @param IdSet $approvedIds
     * @param IdSet $rejectedIds
     *
     * @return ApprovalIdsExceptions
     */
    public static function fromIdSets(IdSet $approvedIds, IdSet $rejectedIds)
    {
        return new ApprovalIdsExceptions($approvedIds, $rejectedIds);
    }

    /**
     * @param int[] $approved
     * @param int[] $rejected
     *
     * @return ApprovalIdsExceptions
     */
    public static function create(array $approved, array $rejected)
    {
        $approvedIds = IdSetFactory::fromArray($approved);
        $rejectedIds = IdSetFactory::fromArray($rejected);

        return static::fromIdSets($approvedIds, $rejectedIds);
    }

    /**
     * @param array $approvalsArr
     *
     * @return ApprovalIdsExceptions
     */
    public static function fromArray($approvalsArr)
    {
        return static::create(
            $approvalsArr[ApprovalIdsExceptions::APPROVED],
            $approvalsArr[ApprovalIdsExceptions::REJECTED]
        );
    }
}
