<?php
include_once 'bdViajeFeliz.php';
class Pasajero
{
    private $nombre;
    private $apellido;
    private $numeroDoc;
    private $numTelefono;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->nombre = '';
        $this->apellido = '';
        $this->numeroDoc = '';
        $this->numTelefono = '';
    }

    public function cargar($nombre, $apellido, $numeroDoc, $numTelefono){
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setNumeroDocumento($numeroDoc);
        $this->setNumeroTelefono($numTelefono);
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getApellido()
    {
        return $this->apellido;
    }

    public function getNumeroDocumento()
    {
        return $this->numeroDoc;
    }

    public function getNumeroTelefono()
    {
        return $this->numTelefono;
    }

    public function setNombre($newNombre)
    {
        $this->nombre = $newNombre;
    }

    public function setApellido($newApellido)
    {
        $this->apellido = $newApellido;
    }

    public function setNumeroDocumento($newNumeroDocumento)
    {
        $this->numeroDoc = $newNumeroDocumento;
    }

    public function setNumeroTelefono($newNumeroTelefono)
    {
        $this->numTelefono = $newNumeroTelefono;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function getmensajeoperacion()
    {
        return $this->mensajeoperacion;
    }

    public static function listar($condicion = "")
	{
		$arregloPersona = null;
		$base = new bdViajeFeliz();
		$consultaPersonas = "Select * from persona";
		if ($condicion != "") {
			$consultaPersonas = $consultaPersonas . ' where ' . $condicion;
		}
		$consultaPersonas .= " order by apellido ";
		//echo $consultaPersonas;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersonas)) {
				$arregloPersona = array();
				while ($row2 = $base->Registro()) {

					$nombre = $row2['nrodoc'];
					$apellido = $row2['nombre'];
					$numeroDoc = $row2['apellido'];
					$numTelefono = $row2['email'];

					$perso = new Pasajero();
					$perso->cargar($nombre, $apellido, $numeroDoc, $numTelefono);
					array_push($arregloPersona, $perso);
				}
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $arregloPersona;
	}


    public function __toString()
    {
        return " 
apellido: {$this->getNombre()}
nombre: {$this->getApellido()}
Numero de Telefono: {$this->getNumeroTelefono()}
Numero DNI: {$this->getNumeroDocumento()}
------------------------";
    }
}
