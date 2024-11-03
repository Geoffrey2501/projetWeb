<?php

declare(strict_types=1);
namespace iutnc\deefy\exception;


use Exception;

/**
 * Class AuthnException
 * @package iutnc\deefy\exception
 */
class AuthnException extends Exception
{

    /**
     * @param string $string
     */
    public function __construct($message = "authentification failed", $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}