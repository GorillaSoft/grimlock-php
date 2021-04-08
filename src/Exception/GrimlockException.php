<?php

namespace Grimlock\Exception;

use Exception;
use Throwable;

/**
 * Class GrimlockException
 * Grimlock's own exception to handle errors
 * @package Grimlock\Exception
 * @author Rubén Darío Huamaní Ucharima
 */
class GrimlockException extends Exception
{

    private $class;

    public function __construct($class, $message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct("[".$class."] -> ".$message, $code, $previous);
    }

    public function __toString(): string
    {
        return __CLASS__. " : [{$this->code}]: {$this->message}\n";
    }

}