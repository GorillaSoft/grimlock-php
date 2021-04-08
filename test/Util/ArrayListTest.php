<?php

namespace Grimlock\Test\Util;

use Grimlock\Util\GrimlockList;
use Grimlock\Exception\GrimlockException;
use PHPUnit\Framework\TestCase;

class ArrayListTest extends TestCase
{

    public function testGetItem()
    {
        $lArray = new GrimlockList();
        $object = "Object";
        $lArray->append($object);

        $this->assertTrue($lArray->getItem(0) != null);
    }

    public function testGetItemException()
    {
        $lArray = new GrimlockList();
        $this->expectException(GrimlockException::class);
        $lArray->getItem(1);
    }

}