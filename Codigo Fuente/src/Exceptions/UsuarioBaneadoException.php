<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 27/6/2019
 * Time: 15:39
 */

class UsuarioBaneadoException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}