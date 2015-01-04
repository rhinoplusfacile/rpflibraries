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

namespace rhinoplusfacile\validator;

/**
 * Description of Validator.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Validator
{

    use \rhinoplusfacile\entity\AutoAccessible;

    /** @var array */
    private $entries = array();
    /** @var array */
    private $message_queue = array();

    public function __construct()
    {
        $this->addMember('message_queue', true, false);
    }

    /**
     *
     * @param string $name
     * @param mixed $member
     * @param string|callable $validate
     */
    public function add($name, &$member, $validate = '')
    {
        $entry = \rhinoplusfacile\di\DI::create('rhinoplusfacile\validator\ValidatorEntry', $name, $member, $validate);
        $this->entries[$name] = $entry;
    }

    /**
     *
     * @return bool
     */
    public function validate()
    {
        $retval = true;
        foreach($this->entries as /* @var $entry \rhinoplusfacile\validator\ValidatorEntry */ $entry)
        {
            $func = $entry->getValidate();
            if(is_callable($func))
            {
                if(!$entry->validate())
                {
                    $this->message_queue[] = "$name failed validation.";
                    $retval = false;
                }
            }
            else
            {
                $func = explode('|', $func);
                foreach($func as $f)
                {
                    if(method_exists($this, $f))
                    {
                        if(!$entry->validate($this->$f))
                        {
                            $this->message_queue[] = "$name failed $f.";
                            $retval = false;
                        }
                    }
                    else
                    {
                        $this->message_queue[] = "$name failed $f because $f does not exist.";
                        $retval = false;
                    }
                }
            }
            return $retval;
        }
    }

    /**
     * Getter for $message_queue.
     * @return array
     */
    public function getMessageQueue()
    {
        return $this->message_queue;
    }

    public function set($member)
    {
        return isset($member);
    }

    public function not_empty($member)
    {
        return !empty($member);
    }

}
