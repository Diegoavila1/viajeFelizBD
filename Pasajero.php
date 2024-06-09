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

public function setIdViaje($idViaje) {
    $this->idViaje = $idViaje;
}

public function getIdViaje() {
    return $this->idViaje;
}

/*
    public function Buscar($id_funcion)
    {
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM obra WHERE id_funcion = " . $id_funcion;
        $resp = false;
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                if ($row2 = $base->Registro()) {
                    parent::Buscar($id_funcion);
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


    public function listar($condicion){
        $arregloObra = [];
        $base = new bdViajeFeliz();
        $consulta = "SELECT * FROM obra ";
        if ($condicion != "") {
            $consulta = $consulta . ' WHERE ' . $condicion;
        }
        if ($base->Iniciar()) {
            if ($base->Ejecutar($consulta)) {
                $arregloObra = array();
                while ($row2 = $base->Registro()) {
                    $obj = new Obra();
                    $obj->Buscar($row2['id_funcion']);
                    array_push($arregloObra, $obj);
                }
            } else {
                $this->setmensajeoperacion($base->getError());
            }
        } else {
            $this->setmensajeoperacion($base->getError());
        }
        return $arregloObra;
    }


    public function insertar()
    {
        $base = new bdViajeFeliz();
        $resp = false;

        if (parent::insertar()) {
            $consultaInsertar = "INSERT INTO obra(id_funcion)
				VALUES (" . parent::getIdFuncion() . ")";
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


    public function eliminar($id_funcion)
    {
        $base = new bdViajeFeliz();
        $resp = false;
        if ($base->Iniciar()) {
            $consultaBorra = "DELETE FROM obra WHERE id_funcion = " . parent::getIdFuncion();
            if ($base->Ejecutar($consultaBorra)) {
                if (parent::eliminar($id_funcion)) {
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
*/
public function __toString()
{
    $resp = parent::__toString();
    $resp = "id viaje :" . $this->getIdViaje();
    return $resp;
}

}