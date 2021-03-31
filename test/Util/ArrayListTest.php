<?php

namespace Grimlock\Test\Util;

use Grimlock\Util\ArrayList;
use Grimlock\Exception\GrimlockException;
use PHPUnit\Framework\TestCase;

class ArrayListTest extends TestCase
{

    public function testGetItem()
    {
        $lArray = new ArrayList();
        $object = "Object";
        $lArray->append($object);

        $this->assertTrue($lArray->getItem(0) != null);
    }

    public function testGetItemException()
    {
        $lArray = new ArrayList();
        $this->expectException(GrimlockException::class);
        $lArray->getItem(1);
    }

}