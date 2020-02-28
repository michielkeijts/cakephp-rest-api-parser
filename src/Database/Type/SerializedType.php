<?php
/*
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector\Database\Type;

use Cake\Database\Driver;
use Cake\Database\Type;
use PDO;

/**
 * Description of SerializedType
 *
 * @author michiel
 */

class SerializedType extends Type
{
    public function toPHP($value, Driver $driver)
    {
        if ($value === null) {
            return null;
        }
        return unserialize($value);
    }

    public function marshal($value)
    {
        if (is_string($value) || $value === null) {
            return $value;
        }
        return unserialize($value);
    }

    public function toDatabase($value, Driver $driver)
    {
        return serialize($value);
    }

    public function toStatement($value, Driver $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
}