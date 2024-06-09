<?php

include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'persona.php';
include_once 'ResponsableV.php';
//include_once 'Pasajero.php';


/** Persona(nrodoc, apellido, nombre, telefono)  */
$bd = new bdViajeFeliz();
$objPersona = new Persona();
$datos = ['nombre' =>"ls23452345o", 'apellido'=>"el 23452345ro", 'documento'=>'3436456356','ptelefono'=> 12678];

if ($bd->iniciar()){
    if($objPersona->Buscar('93284672')){
        echo "Persona encontrada: \n". $objPersona;
    } else {
        echo "Persona no encontrada";
    }

} else {
    echo "Conexion fallida";
}