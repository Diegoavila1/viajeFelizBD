<?php

class Persona {
    private $nombre;
    private $apellido;
    private $documento;
    private $ptelefono;
    private $mensajeoperacion;

    public function __construct() {
        $this->nombre = '';
        $this->apellido = '';
        $this->documento = '';
        $this->ptelefono = '';
    }

    public function cargar($datos)
	{
		$this->setNombre($datos['nombre']);
		$this->setApellido($datos['apellido']);
		$this->setDocumento($datos['documento']);
		$this->setPTelefono($datos['ptelefono']);
	}

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApellido($apellido) {
        $this->apellido = $apellido;
    }

    public function setDocumento($documento) {
        $this->documento = $documento;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellido() {
        return $this->apellido;
    }

    public function getdocumento() {
        return $this->documento;
    }
    
    public function setPTelefono($telefono) {
        $this->ptelefono = $telefono;
    }

    public function getPTelefono() {
        return $this->ptelefono;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setmensajeoperacion($mensajeoperacion){
        $this->mensajeoperacion = $mensajeoperacion;
    }
    
	public function Buscar($documento)
	{
		$base = new bdViajeFeliz();
		$consultaPersona = "Select * from persona where documento=" . $documento;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersona)) {
				if ($row2 = $base->Registro()) {
					$this->setDocumento($documento);
					$this->setNombre($row2['nombre']);
					$this->setApellido($row2['apellido']);
					$this->setPTelefono($row2['ptelefono']);
					$resp = true;
				}
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}
    
	public function listar($condicion = "")
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
					$perso = new Persona();
					$perso->cargar($row2);
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
		$consultaInsertar = "INSERT INTO Persona(documento, apellido, nombre, ptelefono) 
				VALUES (" . $this->getdocumento() . ",'" . $this->getApellido() . "','" . $this->getNombre() . "','" . $this->getPTelefono() . "')";

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

    

    public function modificar()
	{
		$resp = false;
		$base = new bdViajeFeliz();
		$consultaModifica = "UPDATE persona SET apellido='" . $this->getApellido() . "',nombre='" . $this->getNombre() . "' ,telefono='" . $this->getPTelefono() . "' WHERE documento=" . $this->getDocumento();
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaModifica)) {
				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

	public function eliminar()
	{
		$base = new bdViajeFeliz();
		$resp = false;
		if ($base->Iniciar()) {
			$consultaBorra = "DELETE FROM persona WHERE documento=" . $this->getDocumento();
			if ($base->Ejecutar($consultaBorra)) {
				$resp =  true;
			} else {
				$this->setmensajeoperacion($base->getError());
			}
		} else {
			$this->setmensajeoperacion($base->getError());
		}
		return $resp;
	}

    public function __toString() {
        return "apellido: " . $this->getNombre() . "\napellido: " . $this->getApellido() . "\ndocumento: " . $this->getdocumento(). "\nptelefono: " . $this->getPTelefono();
    }
}