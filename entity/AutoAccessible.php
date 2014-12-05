<?php

/*
 * Copyright (C) 2014 Rhino Plus Facile <code at rhinopl.us>
 *
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
 */

namespace rhinoplusfacile\entity;

/**
 * Description of AccessibleEntity.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
trait AutoAccessible
{
    /** @var array */
    private $access_rights = array();

    /**
     * Splits a variable name by underscores and capitalizes for use as getVariableName or setVariableName.
     * @param string $name
     * @return string
     */
    private static function getMungedName($name)
    {
        $munged_name = explode('_', $name);
        array_walk( $munged_name,
                    function(&$v, $k)
                    {
                        $v = ucfirst($v);
                    });
        return implode('', $munged_name);
    }

    /**
     * Tests whether a given member variable has been granted read or write access.
     * @param string $member the name of the member variable
     * @param string $access either 'read' or 'write'
     * @return bool
     */
    private function test_access($member, $access)
    {
        return  (isset($this->access_rights[$member])
                    &&
                $this->access_rights[$member][$access]
                    &&
                property_exists($this, $member));
    }

    /**
     * Determines whether simple read access has been granted for a member variable and if so returns the member value.  If not, looks for a getMemberName() function and if it exists returns its result.  Otherwise triggers a warning.
     * @param string $member
     * @return mixed
     */
    public function __get($member)
    {
        if($this->test_access($member, 'read'))
        {
            return $this->$member;
        }
        else
        {
            $method = 'get' . self::getMungedName($member);
            if(method_exists($this, $method))
            {
                return $this->$method();
            }
            else
            {
                trigger_error(get_class() . '::$' . $member . ' does not exist or is not readable.', E_USER_WARNING);
            }
        }
    }

    /**
     * If a member variable has been given simple read access, returns whether that member is set or not.  Otherwise returns false.
     * @param string $member
     * @return boolean
     */
    public function __isset($member)
    {
        if($this->test_access($member, 'read'))
        {
            return isset($this->$member);
        }
        return false;
    }

    /**
     * Determines whether simple write access has been granted for a member variable and if so writes the value to that member, returning the object itself.  If not, looks for a setMemberName() function and if it exists calls it with the value as an argument and returns the result.  Otherwise triggers a warning.
     * @param string $member
     * @param mixed $value
     * @return mixed
     */
    public function __set($member, $value)
    {
        if($this->test_access($member, 'write'))
        {
            $this->$member = $value;
            return $this;
        }
        else
        {
            $method = 'set' . self::getMungedName($member);
            if(method_exists($this, $method))
            {
                return $this->$method($value);
            }
            else
            {
                trigger_error(get_class() . '::$' . $member . ' does not exist or is not writeable.', E_USER_WARNING);
            }
        }
    }

    /**
     * Interface to add simple read or write access for member variables.  Should only be called once per member variable.
     * @param string $name
     * @param bool $read should this variable be readable
     * @param bool $write should this variable be writeable
     * @throws \InvalidArgumentException
     */
    protected function addMember($name, $read=true, $write=true)
    {
        if(!isset($this->access_rights[$name]))
        {
            $this->access_rights[$name] = array('read'=>$read, 'write'=>$write);
        }
        else
        {
            $class = get_class();
            throw new \InvalidArgumentException("$class::\$$name has already been added as a member variable.  addMember() should only be called once per member.");
        }
    }
}
