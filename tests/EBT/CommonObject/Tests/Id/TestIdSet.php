<?php

/*
 * This file is a part of the Common Object library.
 *
 * (c) 2013 Ebidtech
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EBT\CommonObject\Tests\Id;

use EBT\CommonObject\Id\IdSet;

/**
 * TestIdSet
 */
class TestIdSet extends IdSet
{
    /**
     * @param TestId $id
     */
    public function add(TestId $id)
    {
        $this->addInternal($id);
    }

    /**
     * @param TestId $id
     *
     * @return bool
     */
    public function exists(TestId $id)
    {
        return $this->existsInternal($id);
    }
}
