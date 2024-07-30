<?php

namespace Main\Core\Exceptions;

use Psr\Container\ContainerExceptionInterface;
use Exception;

class ContainerException extends Exception implements ContainerExceptionInterface
{
    /**
     * @param string $message
     * @param int $code
     */
    public function __construct(string $message = '', int $code = 503) {
        parent::__construct($message, $code);
        $this->message = "$message";
        $this->code = $code;
    }
}