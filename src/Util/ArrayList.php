<?php

namespace Grimlock\Util;

use ArrayObject;
use JsonSerializable;
use Grimlock\Exception\GrimlockException;

/**
 * Class ArrayList
 * Class that allows manipulating a list of objects
 * @package Grimlock\Util
 * @author Rubén Darío Huamaní Ucharima
 */
class ArrayList extends ArrayObject implements JsonSerializable
{

    public function jsonSerialize()
    {
        return $this->getArrayCopy();
    }

    public function getItem($index)
    {
        $size = $this->count();
        if ($index >= 0 && $index < $size)
        {
            return $this->offsetGet($index);
        }
        else
        {
            throw new GrimlockException(ArrayList::class, "Index Out Of Bounds");
        }
    }

    public function getSize()
    {
        return $this->count();
    }

}