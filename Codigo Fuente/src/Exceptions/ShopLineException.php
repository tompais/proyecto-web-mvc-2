<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 13/5/2019
 * Time: 08:28
 */

class ShopLineException extends Exception
{
    /**
     * ShopLineException constructor.
     * @param $codigoError
     * @param $mensaje
     */
    public function __construct($codigoError, $mensaje)
    {
        return parent::__construct($mensaje, $codigoError);
    }


}