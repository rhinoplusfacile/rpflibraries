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

/**
 * Description of DbCollection.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class DbCollection extends EntityCollection
{

    /** @var \rhinoplusfacile\db\Connection */
    protected $db;
    /** @var string set in subclass */
    protected $table;
    /** @var string set in subclass */
    protected $collected_class;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->db = \rhinoplusfacile\di\DI::create('rhinoplusfacile\db\Connection');
    }

    public function loadAll()
    {
        $result = $this->db->from($this->table)->get()->result();
        $this->processResult($result);
    }

    public function processResult($result)
    {
        foreach($result as $row)
        {
            $item = \rhinoplusfacile\di\DI::create($this->collected_class);
            $item->processResult($row);
            $this[] = $item;
        }
    }

}
