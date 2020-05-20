<?php
/*
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

namespace CakeApiConnector\Database\Type;

use Cake\Database\DriverInterface;
use Cake\Database\Type\BaseType;
use PDO;
use Cake\Database\TypeInterface;

/**
 * Description of SerializedType
 *
 * @author michiel
 */

class SerializedType extends BaseType implements TypeInterface
{
    public function toPHP($value, DriverInterface $driver)
    {
        if ($value === null) {
            return null;
        }
        return unserialize($value);
    }

    public function marshal($value)
    {
        if (is_array($value) || is_object($value) || $value === null) {
            return $value;
        }
        return unserialize($value);
    }

    public function toDatabase($value, DriverInterface $driver)
    {
        return serialize($value);
    }

    public function toStatement($value, DriverInterface $driver)
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
}