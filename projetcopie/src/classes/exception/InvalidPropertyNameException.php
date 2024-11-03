<?php

declare(strict_types=1);
namespace iutnc\deefy\exception;

/**
 * Class InvalidPropertyNameException
 * @package iutnc\deefy\exception
 */
class InvalidPropertyNameException extends \Exception
{
    /**
     * InvalidPropertyNameException constructor.
     * @param string $message
     * @param int $code
     * @param Exception|null $previous
     */
    public function __construct($message = "", $code = 0, Exception $previous = null){
        parent::__construct($message, $code, $previous);
    }
}