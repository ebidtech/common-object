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

use EBT\Collection\CollectionInterface;
use EBT\Collection\CountableTrait;
use EBT\Collection\EmptyTrait;
use EBT\Collection\GetCollectionTrait;
use EBT\Collection\IterableTrait;
use EBT\CommonObject\Exception\InvalidArgumentException;

/**
 * IdSet
 */
class IdSet implements CollectionInterface
{
    use CountableTrait;
    use EmptyTrait;
    use GetCollectionTrait;
    use IterableTrait;

    const DELIMITER = ',';

    /**
     * @var Id[]
     */
    protected $collection = array();

    /**
     * @param Id[] $ids
     */
    public function __construct(array $ids)
    {
        foreach ($ids as $id) {
            method_exists($this, 'add') ? $this->add($id) : $this->addInternal($id);
        }
    }

    /**
     * This method is final on purpose isn't supposed to be override, instead add a exists()
     *
     * @param Id $id
     *
     * @return bool
     */
    final protected function existsInternal(Id $id)
    {
        /** @var Id $iId */
        foreach ($this as $iId) {
            if ($id->equals($iId)) {
                return true;
            }
        }

        return false;
    }

    /**
     * This method is final on purpose isn't supposed to be override, instead add a add()
     *
     * @param Id $id
     *
     * @throws InvalidArgumentException
     */
    final protected function addInternal(Id $id)
    {
        $exists = method_exists($this, 'exists') ? $this->exists($id) : $this->existsInternal($id);
        if ($exists) {
            throw InvalidArgumentException::alreadyExists('ids', $id);
        }

        $this->collection[] = $id;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $ids = array();

        /** @var Id $id */
        foreach ($this as $id) {
            $ids[] = $id->get();
        }

        return $ids;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $ids = array();

        /** @var Id $id */
        foreach ($this as $id) {
            $ids[] = (string) $id;
        }

        return implode(static::DELIMITER, $ids);
    }
}
