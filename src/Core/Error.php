<?php

declare(strict_types=1);

namespace Main\Core;

use ArgumentCountError;
use ErrorException;

class Error
{
    /**
     * Used to handle error messages, etc.
     *
     * @param $errno
     * @param $errstr
     * @param $errfile
     * @param $errline
     * @return void
     * @throws ErrorException
     */
    public static function errorHandler($errno, $errstr, $errfile, $errline): void
    {
        if (error_reporting() !== 0) {
            http_response_code(500);
            throw new ErrorException($errstr, 0, $errno, $errfile, $errline);
        }
    }
    /**
     * When an exception is thrown, it gets logged to the log folder.
     * The exception message gets specified messages, stack traces, etc.
     *
     * @param $exception
     * @return void
     */
    public static function exceptionHandler($exception): void
    {
        $code = $exception->getCode();
        if ($code != 404) {
            $code = 500;
        }
        http_response_code($code);
        $log = dirname(__DIR__) . '/logs/' . date('Y-m-d') . '.log';
        ini_set('error_log', $log);
        $message = "Uncaught exception: '" . get_class($exception). "'";
        $message .= " with message '" . $exception->getMessage() . "'";
        $message .= " \nStack trace: " . $exception->getTraceAsString();
        $message .= " \nThrown in '" . $exception->getFile()."' on line " . $exception->getLine();
        error_log($message);
    }
}