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
        $this->setNumeroEmpleado($datos['numeroEmpleado']);  //en la base de datos esta como rnumeroempleado
        $this->setNumeroLicencia($datos['numeroLicencia']);  //en la base de datos esta como rnumerolicencia
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

    //mod
    public function Buscar($documento)
	{
		$base = new bdViajeFeliz();
		$consultaPersona = "Select * from responsable where rdocumento=" . $documento;
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

    //mod
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

    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        //cuando insertamos el orden no es docu,nroEmpleado,nroLicencia sino que en la base de datos es al revez no se si influye , el parent que hay llama a la primaria como foreanea
        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO responsable(rdocumento,rnumeroempleado , rnumerolicencia,)VALUES (" . parent::getdocumento() . ", '" . $this->getNumeroEmpleado() . "', " . $this->getNumeroLicencia() . ")";
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaInsertar)) {
                    $resp = true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

//modificado
    public function modificar()
    {
        $resp = false;
        $base = new bdViajeFeliz();
        if (parent::modificar()) {
            $consultaModifica = "UPDATE responsable SET rnumeroempleado = '" . $this->getNumeroEmpleado() . "', rnumerolicencia = " . $this->getNumeroLicencia() . "WHERE rdocumento = " . parent::getDocumento();
            if ($base->Iniciar()) {
                if ($base->Ejecutar($consultaModifica)) {
                    $resp = true;
                } else {
                    $this->setmensajeoperacion($base->getError());
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        }
        return $resp;
    }

    //modficado
    public function eliminar($rdocumento)
    {
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM responsable WHERE rdocumento = " . parent::getdocumento();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar($rdocumento)) {
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


    public function __toString()
    {
        return "
Datos del resposable: 
Numero de empleado: {$this->getNumeroEmpleado()}
Numero de licencia: {$this->getNumeroLicencia()}";
    }
}
