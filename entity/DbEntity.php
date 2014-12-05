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

namespace rhinoplusfacile\entity;

use \DomainException,
    \rhinoplusfacile\db\Connection,
    \rhinoplusfacile\validator\Validator;

/**
 * Description of DbEntity.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
abstract class DbEntity extends Entity
{

    /** @var Connection */
    protected $db;
    /** @var string to be defined by subclass */
    protected $table;
    /** @var \rhinoplusfacile\validator\Validator */
    protected $validator;

    /**
     * Constructor
     * @param mixed $id
     * @param Connection $db
     */
    public function __construct($id = null, Connection $db)
    {
        parent::__construct($id);
        $this->db = $db;
        $this->validator = new Validator;
    }

    /**
     * Lazy load a member object if it isn't already set
     * @param mixed $member Reference to the member variable
     * @param callable $callback function which should return the initialized object
     */
    protected function lazyLoad(&$member, callable $callback)
    {
        if(!isset($member))
        {
            $member = $callback();
        }
    }

    public function load()
    {
        if(!$this->getId())
        {
            throw new DomainException('ID must be defined to load from database.');
        }
        $query = $this->db->from($this->table)->where('id', $this->getId())->get();
        if($query->num_rows)
        {
            $this->processResult($query->row());
            return true;
        }
        return false;
    }

    public function processResult($result)
    {
        $this->setId($result->id);
    }

    protected function getSaveFields()
    {
        return array();
    }

    public function save()
    {
        if($this->validate())
        {
            $fields = $this->getSaveFields();
            $this->db->from($this->table);
            if($this->getId())
            {
                return $this->db->insert($fields);
            }
            else
            {
                return $this->db->update($fields);
            }
        }
    }

    public function validate()
    {
        return $this->validator->validate();
    }

}
