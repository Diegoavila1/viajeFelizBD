<?php

class Persona {
    private $nombre;
    private $apellido;
    private $numDoc;

    public function __construct() {
        $this->nombre = '';
        $this->apellido = '';
        $this->numDoc = '';
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setNumDoc($numDoc) {
        $this->numDoc = $numDoc;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getNumDoc() {
        return $this->numDoc;
    }

    public function __toString() {
        return "Nombre: " . $this->getNombre() . ", Apellido: " . $this->getApellido() . ", NumDoc: " . $this->getNumDoc();
    }
}