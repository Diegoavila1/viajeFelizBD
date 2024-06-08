<?php

class Pasajero
{
    private $nombreInt;
    private $apellidoInt;
    private $numeroDocInt;
    private $numTelefonoInt;

    public function __construct($nombreExt, $apellidoExt, $numeroDocExt, $numTelefonoExt)
    {
        $this->nombreInt = $nombreExt;
        $this->apellidoInt = $apellidoExt;
        $this->numeroDocInt = $numeroDocExt;
        $this->numTelefonoInt = $numTelefonoExt;
    }

    public function getNombre()
    {
        return $this->nombreInt;
    }

    public function getApellido()
    {
        return $this->apellidoInt;
    }

    public function getNumeroDocumento()
    {
        return $this->numeroDocInt;
    }

    public function getNumeroTelefono()
    {
        return $this->numTelefonoInt;
    }

    public function setNombre($newNombre)
    {
        $this->nombreInt = $newNombre;
    }

    public function setApellido($newApellido)
    {
        $this->apellidoInt = $newApellido;
    }

    public function setNumeroDocumento($newNumeroDocumento)
    {
        $this->numeroDocInt = $newNumeroDocumento;
    }

    public function setNumeroTelefono($newNumeroTelefono)
    {
        $this->numTelefonoInt = $newNumeroTelefono;
    }

    public function __toString()
    {
        return " 
Nombre: {$this->getNombre()}
Apellido: {$this->getApellido()}
Numero de Telefono: {$this->getNumeroTelefono()}
Numero DNI: {$this->getNumeroDocumento()}
------------------------";
    }
}
