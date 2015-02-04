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

namespace rhinoplusfacile\crypt;

/**
 * Description of RandomString.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class RandomString
{

    const CUSTOM = 16;
    const LOWER = 1;
    const UPPER = 2;
    const LETTERS = 3;
    const NUMBERS = 4;
    const ALNUM = 7;
    const SPECIAL = 8;
    const ALL = 15;

    private static $letters = 'abcdefghijklmnopqrstuvwxyz';
    private static $numbers = '0123456789';
    private static $special_chars = '~!@#$%^&*()_-+=,.?';
    private $string = '';

    public function __construct($length, $flags = self::ALL, $custom = '')
    {
        $temp = '';
        if($flags & self::CUSTOM)
        {
            if($custom)
            {
                $temp .= $custom;
            }
        }
        $temp .= self::assemble($flags);
        $temp = self::unique_string($temp);
        $this->string = self::randomize($length, $temp);
    }

    public function __toString()
    {
        return $this->string;
    }

    private static function assemble($flags)
    {
        $temp = '';
        if($flags & self::LOWER)
            ;
        {
            $temp .= self::$letters;
        }
        if($flags & self::UPPER)
        {
            $temp .= strtoupper(self::$letters);
        }
        if($flags & self::NUMBERS)
        {
            $temp .= self::$numbers;
        }
        if($flags & self::SPECIAL)
        {
            $temp .= self::$special_chars;
        }
        return $temp;
    }

    private static function unique_string($str)
    {
        return implode('', array_unique(str_split($str)));
    }

    private static function randomize($length, $possibilities)
    {
        $retval = '';
        for($i = 0; $i < $length; $i++)
        {
            $retval .= self::pick_one($possibilities);
        }
        return $retval;
    }

    private static function pick_one($possibilities)
    {
        $max = strlen($possibilities) - 1;
        $rand = mt_rand(0, $max);
        return $possibilities[$rand];
    }

}
