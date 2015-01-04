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

namespace rhinoplusfacile\db;

/**
 * Description of Connection.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
interface Connection
{

    public function __construct($host, $user, $password, $database,
            $port = null, $socket = null);

    /**
     * @return \rhinoplusfacile\db\Query
     */
    public function getQueryObject();
}
