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

use EBT\CommonObject\Exception\InvalidArgumentException;

/**
 * IdFactory
 */
abstract class IdFactory
{
    /**
     * Accepts an integer, string or object, the object needs to have __toString() and will be cast to string. The
     * string must have a integer (just contain digits).
     *
     * @param mixed $id
     *
     * @return Id
     *
     * @throws InvalidArgumentException
     */
    final public static function create($id)
    {
        // is is a object and have __toString() cast it to string
        if (is_object($id) && method_exists($id, '__toString')) {
            $id = (string) $id;
        }

        if ((!is_int($id) && !is_string($id)) || (is_string($id) && !ctype_digit($id))) {
            throw new InvalidArgumentException(
                sprintf(
                    'Expected integer string or integer got "%s"',
                    is_object($id) ? get_class($id) : gettype($id)
                )
            );
        }

        return static::toId((int) $id);
    }

    /**
     * Override me to create a custom Id object instead of Id()
     *
     * @param int $id
     *
     * @return Id
     */
    protected static function toId($id)
    {
        return new Id($id);
    }
}
