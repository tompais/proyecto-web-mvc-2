<?php

class Usuario extends  Model {

    private $id;
    private $nombre;
    private $apellido;
    private $username;
    private $upassword;
    private $email;
    private $telefono;
    private $direccionId;
    private $direccion;
    private $sexoId;
    private $sexo;
    private $rolId;
    private $rol;
    private $fechaNacimiento;
    private $fechaBaneo;
    private $fechaBaja;

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return mixed
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param mixed $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return mixed
     */
    public function getRol()
    {
        return $this->rol;
    }

    /**
     * @param mixed $rol
     */
    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    /**
     * @return mixed
     */
    public function getSexoId()
    {
        return $this->sexoId;
    }

    /**
     * @param mixed $sexoId
     */
    public function setSexoId($sexoId)
    {
        $this->sexoId = $sexoId;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param mixed $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getUpassword()
    {
        return $this->upassword;
    }

    /**
     * @param mixed $upassword
     */
    public function setUpassword($upassword)
    {
        $this->upassword = $upassword;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return mixed
     */
    public function getDireccionId()
    {
        return $this->direccionId;
    }

    /**
     * @param mixed $direccionId
     */
    public function setDireccionId($direccionId)
    {
        $this->direccionId = $direccionId;
    }

    /**
     * @return mixed
     */
    public function getRolId()
    {
        return $this->rolId;
    }

    /**
     * @param mixed $rolId
     */
    public function setRolId($rolId)
    {
        $this->rolId = $rolId;
    }

    /**
     * @return mixed
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param mixed $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return mixed
     */
    public function getFechaBaneo()
    {
        return $this->fechaBaneo;
    }

    /**
     * @param mixed $fechaBaneo
     */
    public function setFechaBaneo($fechaBaneo)
    {
        $this->fechaBaneo = $fechaBaneo;
    }

    /**
     * @return mixed
     */
    public function getFechaBaja()
    {
        return $this->fechaBaja;
    }

    /**
     * @param mixed $fechaBaja
     */
    public function setFechaBaja($fechaBaja)
    {
        $this->fechaBaja = $fechaBaja;
    }

    public function validarNombre() {
        return FuncionesUtiles::esOracion($this->nombre)
            && ($cantLetras = strlen($this->nombre)) <= 15
            && $cantLetras >= 3;
    }

    public function validarApellido() {
        return FuncionesUtiles::esOracion($this->apellido)
            && ($cantLetras = strlen($this->apellido)) <= 15
            && $cantLetras >= 3;
    }

    public function validarUsername() {
        return FuncionesUtiles::esPalabraConNumeros($this->username)
            && ($cantLetras = strlen($this->username)) <= 10
            && $cantLetras >= 3;
    }

    public function validarEmail() {
        return FuncionesUtiles::validarEmail($this->email);
    }

    public function validarTelefono() {
        return (FuncionesUtiles::esEntero($this->telefono)
            || FuncionesUtiles::esCadenaNumerica($this->telefono))
            && strlen($this->telefono) === 10;
    }

    public function validarRol() {
        return (FuncionesUtiles::esEntero($this->rolId) || FuncionesUtiles::esCadenaNumerica($this->rolId))
            && (Roles::ADMINISTRADOR === $this->rolId || Roles::MODERADOR === $this->rolId || Roles::USUARIO === $this->rolId);
    }

    public function validarSexo() {
        return (FuncionesUtiles::esEntero($this->sexoId) || FuncionesUtiles::esCadenaNumerica($this->sexoId))
            && (Sexos::MASCULINO == $this->sexoId || Sexos::FEMENINO == $this->sexoId || Sexos::OTRO == $this->sexoId);
    }

}


?>