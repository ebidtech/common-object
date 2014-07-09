<?php

/**
 * LICENSE: [EMAILBIDDING_DESCRIPTION_LICENSE_HERE]
 *
 * @author     Diogo Rocha <diogo.rocha@emailbidding.com>
 * @copyright  2012-2014 Emailbidding
 * @license    [EMAILBIDDING_URL_LICENSE_HERE]
 */

namespace EBT\CommonObject\ApprovalIdsExceptions;

use EBT\CommonObject\Exception\InvalidArgumentException;

class ApprovalIdsExceptions
{
    const APPROVED = 'approved';

    const REJECTED = 'rejected';

    /**
     * @var int[]
     */
    protected $approved;

    /**
     * @var int[]
     */
    protected $rejected;

    /**
     * @param int[] $approved
     * @param int[] $rejected
     *
     * @throws InvalidArgumentException
     */
    public function __construct(array $approved, array $rejected)
    {
        if (!$this->validateIntPositiveArray($approved)) {
            throw InvalidArgumentException::notPositiveIntegerArray('ApprovalIdsExceptions.approved', $approved);
        }

        if (!$this->validateIntPositiveArray($rejected)) {
            throw InvalidArgumentException::notPositiveIntegerArray('ApprovalIdsExceptions.rejected', $rejected);
        }

        if (count(array_intersect($approved, $rejected)) > 0) {
            throw InvalidArgumentException::approvedRejectedCommonElements($approved, $rejected);
        }

        $this->approved = $approved;
        $this->rejected = $rejected;
    }

    /**
     * @return int[]
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * @return int[]
     */
    public function getRejected()
    {
        return $this->rejected;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            self::APPROVED => $this->approved,
            self::REJECTED => $this->rejected,
        );
    }

    /**
     * Verify if an array has only positive integers
     *
     * @param array $array
     *
     * @return bool
     */
    protected function validateIntPositiveArray(array $array)
    {
        foreach ($array as $id) {

            if (!is_int($id) || $id < 1) {
                return false;
            }
        }

        return true;
    }
}
