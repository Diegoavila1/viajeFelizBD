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
