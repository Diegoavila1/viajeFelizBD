<?php
class Pasajero extends Persona
{
    private $idViaje;
    

   public function __construct()
   {
    parent::__construct();
    $this->idViaje = '';
   }
   
   public function cargar($datos) {
    parent::cargar($datos); 
    $this->setIdViaje($datos[4]);
    }
    /*
    public function cargar($datos) {
        parent::cargar($datos); 
        $this->setIdViaje($datos['idViaje']);
        }
    */
public function setIdViaje($idViaje) {
    $this->idViaje = $idViaje;
}

public function getIdViaje() {
    return $this->idViaje;
}

//modificado
    public function Buscar($idViaje)
    {
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM pasajero WHERE idViaje = " . $idViaje;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($idViaje);
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

//modificado
    public function listar($condicion){
        $arregloPasajero = [];
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM pasajero ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloPasajero = array();
                while ($row2 = $base->Registro()) {
                    $obj = new pasajero();
                    $obj->Buscar($row2['idViaje']);
                    array_push($arregloPasajero, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloPasajero;
    }

    
//modificado
    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO pasajero(idViaje) VALUES (" . parent::getIdViaje() . ")";
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
    public function eliminar($idViaje)
    {
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM pasajero WHERE idViaje = " . parent::getIdViaje();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar($idViaje)) {
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
    $resp = parent::__toString();
    $resp = "id viaje :" . $this->getIdViaje();
    return $resp;
}

}