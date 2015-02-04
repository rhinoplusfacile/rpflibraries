<?php
/*
 * Copyright (C) 2015 Rhino Plus Facile <code at rhinopl.us>
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

namespace rhinoplusfacile\csv;

/**
 * CSV implementation for output only.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class CSV
{

    /** @var array */
    private $headers = array();
    /** @var array */
    private $rows = array();
    /** @var \SplFileObject */
    private $handle;
    /** @var bool */
    private $headers_sent = false;

    public function __construct(\SplFileObject $handle)
    {
        $this->handle = $handle;
    }

    public function addHeader($header_id, $header_title)
    {
        if(!empty($this->rows))
        {
            throw new \LogicException('Headers should not be added after rows have been added.');
        }
        elseif($this->headers_sent)
        {
            throw new \LogicException('Headers should not be added after flush has been called at least once.');
        }
        $this->headers[$header_id] = $header_title;
    }

    public function addRow($row)
    {
        $temp = array();
        foreach(array_keys($this->headers) as $id)
        {
            if(isset($row[$id]))
            {
                $temp[] = $row[$id];
            }
            else
            {
                $temp[] = '';
            }
        }
        $this->rows[] = $temp;
    }

    public function flush()
    {
        $this->writeHeaders();
        foreach($this->rows as $row)
        {
            $this->handle->fputcsv($row);
        }
        $this->rows = array();
    }

    private function writeHeaders()
    {
        if(!$this->headers_sent)
        {
            $this->handle->fputcsv(array_values($this->headers));
            $this->headers_sent = true;
        }
    }

}
