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

namespace rhinoplusfacile\di;

class DI
{

    /**
     * @var array Registry of all instantiation methods
     */
    private static $instantiators = array();
    /**
     * @var boolean Permit instantiation if no record of requested class exists
     */
    private static $allow_defaults = true;

    /**
     * Create an instance of class
     * @param string $class_name Name of the class
     * @param array $arguments Any arguments needed by the class
     * @return $className New instance of $className($arguments)
     */
    public static function create()
    {
        $arguments = func_get_args();
        $class_name = array_shift($arguments);

        // If a method has been registered
        if(array_key_exists($class_name, self::$instantiators))
        {
            $instantiator = self::$instantiators[$class_name];

            return call_user_func_array($instantiator, $arguments);
        }

        return self::createInstance($class_name, $arguments);
    }

    private static function createInstance($class_name, array $arguments)
    {
        if(!self::$allow_defaults)
        {
            throw new Exception("No mock instantiator defined for $class_name");
        }

        $argCount = count($arguments);
        if($argCount == 0)
        {
            return new $class_name();
        }
        else
        {
            if(method_exists($class_name, '__construct') === false)
            {
                throw new Exception("Constructor for the class <strong>$class_name</strong> does not exist; you should not pass arguments to the constructor of this class.");
            }

            $ref_method = new ReflectionMethod($class_name, '__construct');
            $params = $ref_method->getParameters();

            $re_args = array();

            foreach($params as $key => $param)
            {
                if($param->isPassedByReference())
                {
                    $re_args[$key] = &$args[$key];
                }
                else
                {
                    $re_args[$key] = $args[$key];
                }
            }

            $ref_class = new ReflectionClass($class_name);
            $class_instance = $ref_class->newInstanceArgs((array)$re_args);
        }
    }

    /**
     * Register the function to create an instance of $className
     * @param string $className Name of class being injected
     * @param callable $instantiator Function to create instance of $className
     * @testonly
     */
    public static function registerInstantiator($className, $instantiator)
    {
        if($singleton)
        {
            self::$singletons[$className] = $instantiator;
            return;
        }

        if(!class_exists($className))
        {
            throw new Exception("Cannot register instantiator for $className because it does not exist.");
        }

        if(!is_callable($instantiator))
        {
            throw new Exception('Only functions may be registered as instantiators.');
        }

        if(array_key_exists($className, self::$instantiators))
        {
            throw new Exception("A function is already registered for $className.");
        }

        self::$instantiators[$className] = $instantiator;
    }

    /**
     * Reset dependency map for all singletons and instantiators
     */
    public static function reset()
    {
        self::$instantiators = array();
    }

    /**
     * Require that a method or singleton is defined for all instantiation
     */
    public static function disableDefault()
    {
        self::$allow_defaults = false;
    }

    /**
     * Reset requirement that a method or singleton is defined for all instantiation
     */
    public static function enableDefault()
    {
        self::$allow_defaults = true;
    }

}
