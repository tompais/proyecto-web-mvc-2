<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 11/5/2019
 * Time: 10:23
 */

abstract class Constantes
{
    //Vistas
    const INICIOVIEW = "inicio";
    const REGISTRARVIEW = "registrar";
    const LOGINVIEW =  "login";
    const PRODUCTOSVIEW = "misProductos";

    //Títulos
    const MAINTITLE = "ShopLine";
    const REGISTRARTITLE = "Registrar";
    const LOGINTITLE = "Iniciar Sesion";
    const PRODUTOSTITLE = "Ventas";

    //Regex
    const REGEXLETRASYNUMEROS = "/^[0-9a-zA-Z]+$/";
    const REGEXEMAIL = "/^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/";
    const REGEXSOLOLETRAS = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    const REGEXLETRASYESPACIO = "/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/";
    const REGEXSOLONUMEROS = "/^[0-9]+$/";

    //Comparadores
    const CMPBYID = "FuncionesUtiles::cmpById";
    const CMPBYNOMBRE = "FuncionesUtiles::cmpByNombre";

    //Propiedades
    const ID = "Id";
}