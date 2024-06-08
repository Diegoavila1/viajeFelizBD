<?php

include_once 'bdViajeFeliz.php';
include_once 'Viaje.php';
include_once 'ResponsableV.php';
include_once 'Pasajero.php';
$objViaje = new Viaje();
$objPasajero = new Pasajero();


$objPasajero->cargar('Juan', 'Perez', '12345678', '12345678', 1);
$objPasajero->insertar();

