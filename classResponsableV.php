<?php

class ResponsableV
{
    private $numeroEmpleadoInt;
    private $numeroLicienciaInt;
    private $nombreInt;
    private $apellidoInt;

    public function __construct($numeroEmpleadoExt, $numeroLicienciaExt, $nombreExt, $apellidoExt)
    {
        $this->numeroEmpleadoInt = $numeroEmpleadoExt;
        $this->numeroLicienciaInt = $numeroLicienciaExt;
        $this->nombreInt = $nombreExt;
        $this->apellidoInt = $apellidoExt;
    }

    public function getNumeroEmpleado()
    {
        return $this->numeroEmpleadoInt;
    }

    public function getNumeroLicencia()
    {
        return $this->numeroLicienciaInt;
    }

    public function getNombre()
    {
        return $this->nombreInt;
    }

    public function getApellido()
    {
        return $this->apellidoInt;
    }

    public function setNumeroEmpleado($newNumeroEmpleado)
    {
        $this->numeroEmpleadoInt = $newNumeroEmpleado;
    }

    public function setNumeroLicencia($newNumeroLicencia)
    {
        $this->numeroLicienciaInt = $newNumeroLicencia;
    }

    public function setNombre($newNombre)
    {
        $this->nombreInt = $newNombre;
    }

    public function setApellido($newApellido)
    {
        $this->apellidoInt = $newApellido;
    }

    public function __toString()
    {
        return "
Datos del resposable: 
Nombre/s: {$this->getNombre()}
Apellido/s: {$this->getApellido()} 
Numero de empleado: {$this->getNumeroEmpleado()}
Numero de licencia: {$this->getNumeroLicencia()}";
    }
}
