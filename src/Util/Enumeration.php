<?php

namespace Grimlock\Util;

use Grimlock\Exception\GrimlockException;
use ReflectionClass;
use Exception;

/**
 * Class Enumeration
 * @package Grimlock\Util
 * @author Rubén Darío Huamaní Ucharima
 */
class Enumeration
{

    /**
     * @param $class
     * @param $value
     * @return bool
     * @throws GrimlockException
     */
    public static function contains($class, $value)
    {
        try {
            $reflectionCass = new ReflectionClass($class);
            foreach ($reflectionCass->getConstants() as $keyClass => $valueClass) {
                if ($valueClass == $value) {
                    return true;
                }
            }
            return false;
        } catch(Exception $e) {
            throw new GrimlockException(Enumeration::class, $e->getMessage());
        }
    }

}