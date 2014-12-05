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
 * Description of SetList.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class SetList extends SelectList
{

    public function __construct()
    {
        parent::__construct();
    }

    public function add(SelectItem $column, SetItem $item)
    {
        if(!isset($this[$column]))
        {
            $this[$column] = array();
        }
        $this[$column][] = $item;
    }

    public function escape(callable $escape_function)
    {
        parent::escape($escape_function);
        foreach($this as $column)
        {
            foreach($this[$column] as /* @var $value \rhinoplusfacile\db\active_record\SetItem */ $value)
            {
                $value->escape($escape_function);
            }
        }
    }

    public function insert_list()
    {
        $columns = $this->__toString();
        $values = array();
        foreach($this as $column)
        {
            $columns[] = $name;
            foreach($column as /* @var $value \rhinoplusfacile\db\active_record\SetItem */ $value)
            {

            }
        }
    }

}
