<?php

class Viaje
{
    private $objResponsableVInt;
    private $codigoViajeInt;
    private $destinoInt;
    private $cantidadMaximaPasajerosInt;
    private $ColeccionObjspasajerosInt;

    public function __construct($objResponsableVExt, $codigoViajeExt, $destinoExt, $cantidadMaximaPasajerosExt, $pasajerosExt)
    {
        $this->objResponsableVInt = $objResponsableVExt;
        $this->codigoViajeInt = $codigoViajeExt;
        $this->destinoInt = $destinoExt;
        $this->cantidadMaximaPasajerosInt = $cantidadMaximaPasajerosExt;
        $this->ColeccionObjspasajerosInt = $pasajerosExt;
    }

    public function getResponsableV()
    {
        return $this->objResponsableVInt;
    }

    public function getCodigoViaje()
    {
        return $this->codigoViajeInt;
    }

    public function getDestino()
    {
        return $this->destinoInt;
    }

    public function getCantidadMaximaPasajeros()
    {
        return $this->cantidadMaximaPasajerosInt;
    }

    public function getPasajeros()
    {
        return $this->ColeccionObjspasajerosInt;
    }

    public function setResponsableV($newObjResponsable)
    {
        $this->objResponsableVInt = $newObjResponsable;
    }

    public function setCodigoViaje($newCodigoViaje)
    {
        $this->codigoViajeInt = $newCodigoViaje;
    }

    public function setDestino($newDestino)
    {
        $this->destinoInt = $newDestino;
    }

    public function setCantidadMaximaPasajeros($newCantidadMaxima)
    {
        $this->cantidadMaximaPasajerosInt = $newCantidadMaxima;
    }

    public function setPasasejeros($newColeccion)
    {
        $this->ColeccionObjspasajerosInt = $newColeccion;
    }

    public function cantidadActualPasajeros()
    {
        return count($this->getPasajeros());
    }

    
    public function Buscar($id_teatro)
    {
        $base = new BaseDatos();
        $consultaPersona = "SELECT * FROM  WHERE id_teatro = " . $id_teatro;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaPersona)) {
                if ($row2 = $base->Registro()) {
                    $this->setIdTeatro($id_teatro);
                    $this->setNombre($row2['nombre']);
                    $this->setDireccion($row2['direccion']);
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
    /*
        public function listar($condicion)
    {
        $arregloTeatro = [];
        $base = new BaseDatos();
        $consultaTeatro = "SELECT * FROM teatro ";
        if ($condicion != "") {
            $consultaTeatro = $consultaTeatro . ' WHERE ' . $condicion;
        }
        $consultaTeatro .= " ORDER BY nombre";
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaTeatro)) {
                $arregloTeatro = [];
                while ($row2 = $base->Registro()) {
                    $id_teatro = $row2['id_teatro'];
                    $teatro = new Teatro();
                    $teatro->buscar($id_teatro);
                    array_push($arregloTeatro, $teatro);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloTeatro;
    }

    public function insertar()
    {
        $base = new BaseDatos();
        $resp = false;
        $nombre = $this->getNombre();
        $direccion = $this->getDireccion();

        $consulta_insertar = "INSERT INTO teatro(nombre, direccion)
		VALUES ('{$nombre}', '{$direccion}')";

        //debbugin
        //echo "\n".$consulta_insertar."\n";
        if ($base->Iniciar()) {
            if ($id = $base->devuelveIDInsercion($consulta_insertar)) {
                $this->setIdTeatro($id);
                $resp = true;
            } else {
                $this->setMensajeOperacion($base->getError());
            }
        } else {
            $this->setMensajeOperacion($base->getError());
        }
        return $resp;
    }

    public function modificar($id_teatro)
    {
        $resp = false;
        $base = new BaseDatos();
        $consultaModifica = "UPDATE teatro SET nombre = '" . $this->getNombre() . "', direccion = '" . $this->getDireccion() . "' WHERE id_teatro = " . $id_teatro;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consultaModifica)) {
                $resp = true;
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
        $base = new BaseDatos();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM teatro WHERE id_teatro = " . $this->getIdTeatro();
            if ($base->Ejecutar($consultaBorra)) {
                $resp = true;
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $resp;
    }    
    */
    public function encontrarPosicionPasajero($dniParaRastrear)
    {
        $existePasajero = -1;
        $seEncontro = false;
        for ($i = 0; $i < $this->cantidadActualPasajeros() && $seEncontro != true; $i++) {
            if ($this->getPasajeros()[$i]->getNumeroDocumento() == $dniParaRastrear) {
                $existePasajero = $i;
                $seEncontro = true;
            }
        }
        return $existePasajero;
    }

    public function modificarPasajero($numeroDniPasajero, $newNombre, $newApellido, $newNuevoTelefono)
    {
        $pasajero = 'no hay pasajero con ese dni';

        if ($this->encontrarPosicionPasajero($numeroDniPasajero) != -1) {
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setNombre($newNombre);
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setApellido($newApellido);
            $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)]->setNumeroTelefono($newNuevoTelefono);

            $pasajero = $this->getPasajeros()[$this->encontrarPosicionPasajero($numeroDniPasajero)];
        }
        return $pasajero;
    }

    public function cambiarResponsable($numeroLicencia, $numEmpleado, $nombre, $apellido)
    {
        $responsable = 'no hay responsable con ese numero de licencia';
        if ($this->getResponsableV()->getNumeroLicencia() == $numeroLicencia) {
            $this->getResponsableV()->setNombre($nombre);
            $this->getResponsableV()->setApellido($apellido);
            $this->getResponsableV()->setNumeroEmpleado($numEmpleado);
            $responsable = $this->getResponsableV();
        }
        return $responsable;
    }

    public function mostrarPasajeros()
    {
        $texto = "";
        $i=1;
        foreach ($this->getPasajeros() as $pasajeroIndividual) {
            $texto .= "pasajero ". $i .": ". $pasajeroIndividual . "\n";
            $i++;
        }

        return $texto;
    }

    public function __toString()
    {
        return "
{$this->getResponsableV()}
********************************
Datos del viaje:
codigo del destino: {$this->getCodigoViaje()}
destino: {$this->getDestino()}
cantidad Maxima de pasajeros: {$this->getCantidadMaximaPasajeros()}
********************************
{$this->mostrarPasajeros()}";
    }
}
