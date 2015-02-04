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

namespace rhinoplusfacile\crypt;

/**
 * Description of Crypt.
 *
 * @author Rhino Plus Facile <code at rhinopl.us>
 */
class Crypt
{

    private $key;
    private $iv_size;

    public function __construct($key)
    {
        $this->key = $key;
        $this->iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
    }

    public function encrypt($message)
    {
        $iv = mcrypt_create_iv($this->iv_size, MCRYPT_RAND);

        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $this->key, $message, MCRYPT_MODE_CBC, $iv);
        $ciphertext = $iv . $ciphertext;

        return base64_encode($ciphertext);
    }

    public function decrypt($ciphertext)
    {
        $ciphertext_dec = base64_decode($ciphertext);

        $iv_dec = substr($ciphertext_dec, 0, $this->iv_size);
        $ciphertext_dec = substr($ciphertext_dec, $this->iv_size);

        return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $this->key, $ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec), "\0");
    }

}
