<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 13/5/2019
 * Time: 17:22
 */

class SQLInsertException extends ShopLineException
{
    public function __construct($codigoError, $mensaje)
    {
        parent::__construct($codigoError, $mensaje);
    }
}