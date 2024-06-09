<?php

class ResponsableV extends Persona
{
    private $numeroEmpleadoInt;
    private $numeroLicienciaInt;

    public function __construct()
    {
        parent::__construct();
        $this->numeroEmpleadoInt = '';
        $this->numeroLicienciaInt = '';
    }

    public function cargar($datos)
    {
        parent::cargar($datos);
        $this->setNumeroEmpleado($datos['numeroEmpleado']);
        $this->setNumeroLicencia($datos['numeroLicencia']);
    }

    public function getNumeroEmpleado()
    {
        return $this->numeroEmpleadoInt;
    }

    public function getNumeroLicencia()
    {
        return $this->numeroLicienciaInt;
    }

    public function getmensajeoperacion(){
        return $this->mensajeoperacion;
    }

    public function setmensajeoperacion($mensajeoperacion)
    {
        $this->mensajeoperacion = $mensajeoperacion;
    }

    public function setNumeroEmpleado($newNumeroEmpleado)
    {
        $this->numeroEmpleadoInt = $newNumeroEmpleado;
    }

    public function setNumeroLicencia($newNumeroLicencia)
    {
        $this->numeroLicienciaInt = $newNumeroLicencia;
    }

    public function Buscar($documento)
	{
		$base = new bdViajeFeliz();
		$consultaPersona = "Select * from responsable where documento=" . $documento;
		$resp = false;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersona)) {
				if ($row2 = $base->Registro()) {
					parent::Buscar($documento);
                    $this->setNumeroEmpleado($row2['numeroEmpleado']);
                    $this->setNumeroLicencia($row2['numeroLicencia']);
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
		$consultaPersonas = "Select * from responsable";
		if ($condicion != "") {
			$consultaPersonas = $consultaPersonas . ' where ' . $condicion;
		}
		$consultaPersonas .= " order by rnumeroempleado";
		//echo $consultaPersonas;
		if ($base->Iniciar()) {
			if ($base->Ejecutar($consultaPersonas)) {
				$arregloPersona = array();
				while ($row2 = $base->Registro()) {
					$perso = new ResponsableV();
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
