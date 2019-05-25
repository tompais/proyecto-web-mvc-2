<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 13/5/2019
 * Time: 01:39
 */

abstract class CodigoError
{
    const DireccionInvalida = 1;
    const ErrorInsertSQL = 2;
    const UsuarioInvalido = 3;
    const EntidadDuplicada = 4;
    const PasswordInvalida = 5;
    const GeolocalizacionInvalida = 6;
    const EmailOrNickInvalido = 7;
    const NombreProductoInvalido = 9;
    const PrecioProductoInvalido = 10;
    const CategoriaProductoInvalido = 11;
    const DescripcionProductoInvalido = 12;
    const ErrorUpdateSQL = 13;
    const EnvioMailRenovacionPasswordFallido = 14;
}