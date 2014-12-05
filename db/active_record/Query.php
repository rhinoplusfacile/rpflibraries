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

use \rhinoplusfacile\db\Query as BaseQuery;

/**
 * Description of Query.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
abstract class Query extends BaseQuery
{

    /** @var \rhinoplusfacile\db\active_record\SelectList */
    private $select_list;
    private $set_list;

    /**
     * Add an item or items to the SELECT list.  If this function is called multiple times it should add additional items, with whether or not to escape them determined by $escape.
     * @param mixed $items
     * @param bool $escape
     */
    public function select(array $items)
    {
        
    }

    public function set($item, $value)
    {

    }

    public function insert();

    public function update();

    public function delete();

    /**
     * Add a table or tables to the query (can be used for INSERTs and UPDATES as well).  If this function is called multiple times it should add additional tables.
     * @param mixed $tables
     */
    public function from($tables);

    /**
     * Add a JOIN, type determined by $type, ON $condition.
     * @param mixed $table
     * @param mixed $condition
     * @param mixed $type
     */
    public function join($table, $condition, $type = 'left');

    public function where($condition);

    public function getText()
    {
        return parent::getText();
    }

}
