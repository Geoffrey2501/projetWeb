<?php

declare(strict_types=1);
namespace iutnc\deefy\exception;
use Exception;

/**
 * Class AuthzException
 * @package iutnc\deefy\exception
 */
class AuthzException extends Exception
{
    /**
     * @param string $string
     */
    public function __construct($message = "permission denied", $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}