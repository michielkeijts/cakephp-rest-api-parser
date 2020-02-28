<?php
/* 
 * @copyright (C) 2020 Michiel Keijts, Normit
 * 
 */

use Cake\Database\Type;

Type::map('serialized', CakeApiConnector\Database\Type\SerializedType::class);