<?php
/**
 * Created by PhpStorm.
 * User: Globons
 * Date: 12/5/2019
 * Time: 13:56
 */

class Direccion extends Model
{
    private $id;
    private $calle;
    private $altura;
    private $piso;
    private $departamento;
    private $provinciaId;
    private $provincia;
    private $partidoId;
    private $partido;
    private $localidadId;
    private $localidad;

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
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param mixed $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return mixed
     */
    public function getAltura()
    {
        return $this->altura;
    }

    /**
     * @param mixed $altura
     */
    public function setAltura($altura)
    {
        $this->altura = $altura;
    }

    /**
     * @return mixed
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param mixed $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
    }

    /**
     * @return mixed
     */
    public function getDepartamento()
    {
        return $this->departamento;
    }

    /**
     * @param mixed $departamento
     */
    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
    }

    /**
     * @return mixed
     */
    public function getProvinciaId()
    {
        return $this->provinciaId;
    }

    /**
     * @param mixed $provinciaId
     */
    public function setProvinciaId($provinciaId)
    {
        $this->provinciaId = $provinciaId;
    }

    /**
     * @return mixed
     */
    public function getProvincia()
    {
        return $this->provincia;
    }

    /**
     * @param mixed $provincia
     */
    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
    }

    /**
     * @return mixed
     */
    public function getPartidoId()
    {
        return $this->partidoId;
    }

    /**
     * @param mixed $partidoId
     */
    public function setPartidoId($partidoId)
    {
        $this->partidoId = $partidoId;
    }

    /**
     * @return mixed
     */
    public function getPartido()
    {
        return $this->partido;
    }

    /**
     * @param mixed $partido
     */
    public function setPartido($partido)
    {
        $this->partido = $partido;
    }

    /**
     * @return mixed
     */
    public function getLocalidadId()
    {
        return $this->localidadId;
    }

    /**
     * @param mixed $localidadId
     */
    public function setLocalidadId($localidadId)
    {
        $this->localidadId = $localidadId;
    }

    /**
     * @return mixed
     */
    public function getLocalidad()
    {
        return $this->localidad;
    }

    /**
     * @param mixed $localidad
     */
    public function setLocalidad($localidad)
    {
        $this->localidad = $localidad;
    }

    public function validarDireccion()
    {
        require_once ROOT . "Models/Provincia.php";
        require_once ROOT . "Models/Partido.php";
        require_once ROOT . "Models/Localidad.php";

        $this->setProvincia(new Provincia());
        $this->setPartido(new Partido());
        $this->setLocalidad(new Localidad());

        $validacion = $this->provincia->getById($this->getProvinciaId())
        && $this->partido->getById($this->getPartidoId())
        && $this->localidad->getById($this->getLocalidadId())
        && $this->provincia->getId() == $this->partido->getProvinciaId()
        && $this->partido->getId() == $this->localidad->getPartido()
        && FuncionesUtiles::esPalabra($this->getCalle())
        && (FuncionesUtiles::esEntero($this->getAltura()) || FuncionesUtiles::esCadenaNumerica($this->getAltura()))
        && (!FuncionesUtiles::esCadenaNoNulaOVacia($this->getPiso()) && !FuncionesUtiles::esCadenaNoNulaOVacia($this->getDepartamento())
            || ((FuncionesUtiles::esEntero($this->getPiso()) || FuncionesUtiles::esCadenaNumerica($this->getPiso())) && FuncionesUtiles::esPalabra($this->getDepartamento())));

        return $validacion;

    }

    public function existeDireccion()
    {
        $row = $this->pageRows(0, 1, "Nombre LIKE '$this->calle' AND Altura = $this->altura AND Piso = $this->piso AND Departamento LIKE '$this->departamento' AND ProvinciaId = $this->provinciaId AND PartidoId = $this->partidoId AND LocalidadId = $this->localidadId");

        if($row)
            $this->setId($row[0]['Id']);

        return $row;
    }

    public function insertarDireccion()
    {
        $array = [
            "Calle" => $this->getCalle(),
            "Altura" => $this->getAltura(),
            "Piso" => $this->getPiso(),
            "Departamento" => $this->getDepartamento(),
            "ProvinciaId" => $this->getProvinciaId(),
            "PartidoId" => $this->getPartidoId(),
            "LocalidadId" => $this->getLocalidadId()
        ];
        $this->setId($this->insert($array));
        return $this->getId();
    }

    public function getIdLastInsert()
    {
        $this->setId($this->db->getInsertId());
    }
}