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
 * Description of TableJoin.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class TableJoin implements Escapable
{

    use \rhinoplusfacile\entity\AutoAccessible;

    private $name;
    private $alias = null;
    private $join_type = null;
    private $condition = null;

    public function __construct($name, $alias = null, $join_type = null,
            $condition = null)
    {
        $this->name = $name;
        $this->addMember('name', true, false);
        $this->alias = $alias;
        $this->addMember('alias', true, false);
        $this->join_type = $join_type;
        $this->condition = $condition;
        $this->addMember('condition', true, false);
    }

    public function getJoinType()
    {
        return strtoupper($this->join_type);
    }

    public function escape(callable $escape_function)
    {
        $this->name = $escape_function($this->name);
        $this->alias = $escape_function($this->alias);
    }

//put your code here
}
