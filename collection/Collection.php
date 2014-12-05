<?php
/*
 * Copyright (C) 2014 Rhino Plus Facile <code at rhinopl.us>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace rhinoplusfacile\collection;

use \ArrayAccess,
    \ArrayIterator,
    \IteratorAggregate,
    \rhinoplusfacile\entity\Entity;

/**
 * Description of Collection.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Collection extends Entity implements ArrayAccess, IteratorAggregate
{

    private $data = array();

    public function __construct($id = null)
    {
        parent::__construct();
        $args = func_get_args();
        if(count($args) > 1)
        {
            $args = array_slice($args, 1);
            foreach($args as $arg)
            {
                $this[] = $arg;
            }
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->data[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->data[$offset];
    }

    public function offsetSet($offset, $value)
    {
        if($offset == null)
        {
            $this->data[] = $value;
        }
        else
        {
            $this->data[$offset] = $value;
        }
    }

    public function offsetUnset($offset)
    {
        unset($this->data[$offset]);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->data);
    }

}
