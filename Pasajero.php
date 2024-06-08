<?php
include_once 'bdViajeFeliz.php';
class Pasajero
{
    private $nombre;
    private $apellido;
    private $numeroDoc;
    private $numTelefono;
    private $idviaje;
    private $mensajeoperacion;

    public function __construct()
    {
        $this->nombre = '';
        $this->apellido = '';
        $this->numeroDoc = '';
        $this->numTelefono = '';
    }

    public function cargar($nombre, $apellido, $numeroDoc, $numTelefono, $idviaje){
        $this->setNombre($nombre);
        $this->setApellido($apellido);
        $this->setNumeroDocumento($numeroDoc);
        $this->setNumeroTelefono($numTelefono);
        $this->setIdviaje($idviaje);
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

    public function getIdviaje(){
        return $this->idviaje;
    }

    public function setIdviaje($idviaje){
        $this->idviaje = $idviaje;
    }

    public static function listar($condicion = "")
	{
		$arregloPersona = null;
		$base = new bdViajeFeliz();
		$consultaPersonas = "Select * from Pasajero";
		if ($condicion != "") {
			$consultaPersonas = $consultaPersonas . ' where ' . $condicion;
		}
		$consultaPersonas .= " order by apellido ";
		//echo $consultaPersonas;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersonas)) {
				$arregloPersona = array();
				while ($row2 = $base->Registro()) {

					$nombre = $row2['pdocumento'];
					$apellido = $row2['pnombre'];
					$numeroDoc = $row2['papellido'];
					$numTelefono = $row2['ptelefono'];
                    $idviaje = $row2['idviaje'];

					$perso = new Pasajero();
					$perso->cargar($nombre, $apellido, $numeroDoc, $numTelefono, $idviaje);
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

    public function insertar()
	{
		$base = new bdViajeFeliz();
		$resp = false;
		$consultaInsertar = "INSERT INTO Pasajero (pdocumento, pnombre, papellido, ptelefono, idviaje) 
				VALUES (" . $this->getNumeroDocumento() . ",'" . $this->getApellido() . "','" . $this->getNombre() . "','" . $this->getNumeroTelefono() . "','" . $this->getIdviaje() ."')";

		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaInsertar)) {
				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
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
