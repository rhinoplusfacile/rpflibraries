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

/**
 * Description of SelectItem.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Item implements Escapable
{

    use \rhinoplusfacile\entity\AutoAccessible;

    /** @var string */
    private $item;
    /** @var bool */
    private $escape;

    public function __construct($item, $escape = true)
    {
        $this->item = strtolower($item);
        $this->escape = $escape;

        $this->addMember('item', true, false);
        $this->addMember('escape', true, false);
    }

    public function escape(callable $escape_function)
    {
        if($this->escape)
        {
            $this->item = $escape_function($this->item);
        }
    }

    public function __toString()
    {
        return $this->item;
    }

}
