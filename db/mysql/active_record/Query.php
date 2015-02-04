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

namespace rhinoplusfacile\db\mysql\active_record;

/**
 * Description of Query.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Query extends \rhinoplusfacile\db\active_record\Query
{

    private $tables = array();

    public function delete()
    {

    }

    public function from($table, $alias = null, $join_type = null,
            $condition = null)
    {

    }

    public function insert()
    {

    }

    public function join($table, $condition, $type = 'left')
    {

    }

    public function set($item, $value)
    {

    }

    public function update()
    {

    }

    public function where($condition)
    {

    }

    public function getText()
    {
        $text = '';
        if(!empty($this->selects))  //Select query
        {
            $text .= 'SELECT ';
            $text .= implode(', ', $this->parseSelects());
            $text .= ' FROM ';
            $ts = array();
            $joins = array();
            foreach($tables as /* @var $table \rhinoplusfacile\db\active_record\TableJoin */ $table)
            {
                $table->escape($this->handle->escape);
                if($table->join_type)
                {

                }
            }
        }
    }

}
