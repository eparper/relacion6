<?php
//no quiero que se muestre ningún error: 
//error_reporting(0);
date_default_timezone_set("Europe/Berlin");

define("RUTABASE", dirname(__FILE__));
//define("MODO_TRABAJO","produccion"); //en "produccion o en desarrollo
define("MODO_TRABAJO","desarrollo"); //en "produccion o en desarrollo

if (MODO_TRABAJO=="produccion")
    error_reporting(0);
    else 
        error_reporting(E_ALL & ~E_DEPRECATED);  

spl_autoload_register(function ($clase){
    $ruta=RUTABASE."/aplicacion/clases/curso2026/";
    $fichero=$ruta."$clase.php";
    
    if (file_exists($fichero))
        {
            require_once($fichero);
        }
      else
        {
            throw new Exception("La clase $clase no se ha encontrado.");
        }
});


include(RUTABASE."/aplicacion/plantilla/plantilla.php");

require_once(RUTABASE."/scripts/librerias/validacion.php");

//creo todos los objetos que necesita mi aplicación
$muebles = [];

// Muebles reciclados
$muebles[1] = new MuebleReciclado(
    "Mesa ecológica",
    "EcoMuebles",
    "ESPAÑA",
    2022,
    "01/01/2022",
    "31/12/2042",
    120.50,
    85
);

// Mueble 1
$muebles[1]->anadirCaracteristicas("color", "verde", "extensible", true);

$muebles[2] = new MuebleReciclado(
    "Silla reciclada",
    "GreenDesign",
    "FRANCIA",
    2021,
    "01/03/2021",
    "31/12/2041",
    45.90,
    70
);

// Mueble 2
$muebles[2]->anadirCaracteristicas("color", "azul", "apilable", true);

$muebles[3] = new MuebleReciclado(
    "Estantería sostenible",
    "EcoHogar",
    "ESPAÑA",
    2023,
    "01/06/2023",
    "31/12/2043",
    95.00,
    90
);

// Mueble 3
$muebles[3]->anadirCaracteristicas("numeroBaldas", 5, "montaje", "pared");

// Muebles tradicionales
$muebles[4] = new MuebleTradicional(
    "Armario clásico",
    "Muebles López",
    "ITALIA",
    2020,
    "01/01/2020",
    "31/12/2040",
    350.00,
    80.5,
    "A12"
);

// Mueble 4
$muebles[4]->anadirCaracteristicas("numeroPuertas", 4, "tieneEspejo", true);

$muebles[5] = new MuebleTradicional(
    "Sofá tradicional",
    "ConfortHome",
    "ESPAÑA",
    2022,
    "01/05/2022",
    "31/12/2042",
    550.00,
    95.0,
    "S25"
);

// Mueble 5
$muebles[5]->anadirCaracteristicas("numeroPlazas", 3, "reclinable", false);

