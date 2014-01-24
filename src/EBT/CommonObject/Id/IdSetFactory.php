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

use EBT\Validator\ValidatorBasicExtended;
use EBT\CommonObject\Exception\InvalidArgumentException;

/**
 * IdSetFactory
 */
abstract class IdSetFactory
{
    const DELIMITER = ',';

    /**
     * @param array $idsArr
     *
     * @return IdSet
     */
    public static function fromArray(array $idsArr)
    {
        $ids = array();

        foreach ($idsArr as $id) {
            $ids[] = static::fromId($id);
        }

        return static::fromIds($ids);
    }

    /**
     * @param string $idsStr Eg: '1, 3,  5, 10'
     *
     * @return IdSet
     *
     * @throws InvalidArgumentException
     */
    public static function fromString($idsStr)
    {
        if (!ValidatorBasicExtended::isTypeString($idsStr)) {
            throw InvalidArgumentException::notString('ids', $idsStr);
        }

        $idsStr = preg_replace('/\s+/', '', $idsStr);

        $idsArr = $idsStr == '' ? array() : explode(static::DELIMITER, $idsStr);

        return static::fromArray($idsArr);
    }

    /**
     * @param Id[] $ids
     *
     * @return IdSet
     */
    public static function fromIds($ids)
    {
        return new IdSet($ids);
    }

    /**
     * @param mixed $id
     *
     * @return Id
     */
    protected static function fromId($id)
    {
        return IdFactory::create($id);
    }
}
