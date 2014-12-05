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
 * Description of ArbitraryCondition.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class ArbitraryCondition extends Condition
{

    /** @var string */
    private $text;

    /**
     * Constructor
     * @param string $text
     */
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Empty function because no escaping is performed on an arbitrary text condition; the user is responsible for any escaping that is needed.
     * @param callable $escape_function
     */
    public function escape(callable $escape_function)
    {
        return;
    }

    /**
     *
     * @return string
     */
    public function __toString()
    {
        return $this->text;
    }

}
