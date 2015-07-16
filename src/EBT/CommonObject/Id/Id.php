<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\Id;

use EBT\Validator\Model\Validator\Validator;
use EBT\CommonObject\Exception\InvalidArgumentException;

/**
 * Id
 */
class Id
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @param int $id
     *
     * @throws InvalidArgumentException
     */
    public function __construct($id)
    {
        $this->setId($id);
    }

    /**
     * You should override this if you want a custom exception or if you want to have a ZeroId.
     *
     * @param int $id
     *
     * @throws InvalidArgumentException
     */
    protected function setId($id)
    {
        if (!Validator::isRequiredPositiveInteger($id)) {
            throw InvalidArgumentException::notPositiveInteger('id', $id);
        }

        $this->id = $id;
    }

    /**
     * @return int
     */
    public function get()
    {
        return $this->id;
    }

    /**
     * @param Id $id
     *
     * @return bool
     */
    public function equals(Id $id)
    {
        return $this->get() === $id->get();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string) $this->get();
    }
}
