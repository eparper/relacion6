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
    $ruta=RUTABASE."/scripts/clases/";
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

//para autocarga de muchas carpetas:
// spl_autoload_register(function ($clase){
//     $carpetas = [
//         RUTABASE . "/scripts/clases/",
//         RUTABASE . "/scripts/librerias/"
//     ];

//     foreach ($carpetas as $ruta) {
//         $fichero = $ruta . "$clase.php";

//         // Si encontramos el archivo en esta carpeta, lo cargamos y salimos de la función
//         if (file_exists($fichero)) {
//             require_once $fichero;
//             return; // Éxito: detenemos el autoload para esta clase
//         }
//     }

//     throw new Exception("La clase '$clase' no se ha encontrado en ninguna de las rutas configuradas.");
// });

include(RUTABASE."/aplicacion/plantilla/plantilla.php");

//creo todos los objetos que necesita mi aplicación
