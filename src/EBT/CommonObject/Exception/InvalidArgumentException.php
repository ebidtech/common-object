<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\Exception;

/**
 * InvalidArgumentException
 */
class InvalidArgumentException extends \InvalidArgumentException
{
    /**
     * @param string $property
     * @param mixed  $value
     *
     * @return InvalidArgumentException
     */
    public static function notString($property, $value)
    {
        return new static(sprintf('"%s" not string type: "%s"', $property, static::getStringRepresentation($value)));
    }

    /**
     * @param string $property
     * @param mixed  $value
     *
     * @return InvalidArgumentException
     */
    public static function notPositiveInteger($property, $value)
    {
        return new static(
            sprintf('"%s" expected positive integer got: "%s"', $property, static::getStringRepresentation($value))
        );
    }

    /**
     * @param string $property
     * @param mixed $value
     *
     * @return InvalidArgumentException
     */
    public static function alreadyExists($property, $value)
    {
        return new static(
            sprintf('"%s" already exists on "%s"', static::getStringRepresentation($value), $property)
        );
    }

    /**
     * @param string $property
     * @param mixed  $value
     *
     * @return InvalidArgumentException
     */
    public static function notPositiveIntegerArray($property, $value)
    {
        return new static(
            sprintf(
                '"%s" expected array of positive integers got: "%s"',
                $property,
                static::getStringRepresentation($value)
            )
        );
    }

    /**
     * @param array $approved
     * @param array $rejected
     *
     * @return InvalidArgumentException
     */
    public static function approvedRejectedCommonElements(array $approved, array $rejected)
    {
        return new static(
            sprintf(
                '"%s" already exists on "%s"',
                static::getStringRepresentation($approved),
                static::getStringRepresentation($rejected)
            )
        );
    }

    /**
     * @param mixed $value
     *
     * @return string
     */
    protected static function getStringRepresentation($value)
    {
        return is_object($value) && !method_exists($value, '__toString')
            ? get_class($value)
            : (is_array($value) ? 'Array' : (string) $value);
    }
}
