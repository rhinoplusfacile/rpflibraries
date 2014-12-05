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

namespace rhinoplusfacile\db;

/**
 * Description of Query.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
abstract class Query
{

    private $text = '';

    /**
     * Wipes out the query and sets it to run whatever SQL command is contained in the text.
     * @param string $text
     * @return \rhinoplusfacile\db\Query return $this
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }

    /**
     * Gets SQL, in a string, for whatever command this query has formed.
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

}
