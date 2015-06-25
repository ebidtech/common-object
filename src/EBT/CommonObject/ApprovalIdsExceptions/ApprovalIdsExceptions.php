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

use EBT\CommonObject\Exception\InvalidArgumentException;
use EBT\CommonObject\Id\IdFactory;
use EBT\CommonObject\Id\IdSet;

class ApprovalIdsExceptions
{
    const APPROVED = 'approved';

    const REJECTED = 'rejected';

    /**
     * @var IdSet
     */
    protected $approved;

    /**
     * @var IdSet
     */
    protected $rejected;

    /**
     * @param IdSet $approved
     * @param IdSet $rejected
     *
     * @throws InvalidArgumentException
     */
    public function __construct(IdSet $approved, IdSet $rejected)
    {
        if ($approved->intersects($rejected)) {
            throw InvalidArgumentException::approvedRejectedCommonElements($approved->toArray(), $rejected->toArray());
        }

        $this->approved = $approved;
        $this->rejected = $rejected;
    }

    /**
     * @return IdSet
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @return IdSet
     */
    public function getRejected()
    {
        return $this->rejected;
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function isIdApproved($id)
    {
        return $this->approved->existsInternal(IdFactory::create($id));
    }

    /**
     * @param int $id
     *
     * @return bool
     */
    public function isIdRejected($id)
    {
        return $this->rejected->existsInternal(IdFactory::create($id));
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            self::APPROVED => $this->approved->toArray(),
            self::REJECTED => $this->rejected->toArray(),
        );
    }
}
