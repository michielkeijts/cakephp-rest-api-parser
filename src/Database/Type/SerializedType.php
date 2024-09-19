<?php
declare(strict_types=1);

/*
 * @copyright (C) 2024 Michiel Keijts, Normit
 *
 */

namespace CakeApiConnector\Database\Type;

use Cake\Database\Driver;
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
    public function toPHP(mixed $value, Driver $driver): mixed
    {
        if ($value === null) {
            return null;
        }
        return unserialize($value);
    }

    public function marshal(mixed $value): mixed
    {
        if (is_array($value) || is_object($value) || $value === null) {
            return $value;
        }
        return unserialize($value);
    }

    public function toDatabase(mixed $value, Driver $driver): mixed
    {
        return serialize($value);
    }

    public function toStatement(mixed $value, Driver $driver): int
    {
        if ($value === null) {
            return PDO::PARAM_NULL;
        }
        return PDO::PARAM_STR;
    }
}
