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
 * Description of Value.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Value implements Escapable
{

    private $value;
    private $escape;

    use \rhinoplusfacile\entity\AutoAccessible;

    public function escape(callable $escape_function)
    {
        if($this->escape)
        {
            $this->value = $escape_function($this->item);
        }
    }

    public function __toString()
    {
        return $this->value;
    }

//put your code here
}
