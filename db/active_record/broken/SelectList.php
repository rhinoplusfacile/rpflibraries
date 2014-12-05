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

namespace rhinoplusfacile\db\active_record;

use \rhinoplusfacile\collection\EntityCollection;

/**
 * Description of SelectList.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class SelectList extends \SplObjectStorage implements Escapable
{

    public function escape(callable $escape_function)
    {
        foreach($this as /* @var $item \rhinoplusfacile\db\active_record\SelectItem */ $item)
        {
            $item->escape($escape_function);
        }
    }

    public function __toString()
    {
        $retval = array();
        foreach($this as /* @var $item \rhinoplusfacile\db\active_record\SelectItem */ $item)
        {
            $retval[] = $item->__toString();
        }
        return implode(' ', $retval);
    }

    public function add(SelectItem $item)
    {
        $this->attach($item);
    }

}
