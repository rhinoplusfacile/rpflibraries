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
class SelectItem implements Escapable
{

    use \rhinoplusfacile\entity\AutoAccessible;

    /** @var string */
    private $item;
    /** @var bool */
    private $escape;
    /** @var string */
    private $alias;

    public function __construct($item, $alias = null, $escape = true)
    {
        $this->item = strtolower($item);
        if(isset($alias))
        {
            $this->alias = strtolower($alias);
        }
        $this->escape = $escape;

        $this->addMember('item', true, false);
        $this->addMember('escape', true, false);
        $this->addMember('alias', true, false);
    }

    public function escape(callable $escape_function)
    {
        if($this->escape)
        {
            $this->item = $escape_function($this->item);
            if($this->alias)
            {
                $this->alias = $escape_function($this->alias);
            }
        }
    }

    public function __toString()
    {
        return $this->item . ($this->alias ? : (' AS ' . $this->alias));
    }

}
