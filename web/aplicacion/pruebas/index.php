<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barraUbicacion = [
    [
        "nombre" => "Inicio",
        "url" => "/index.php"
    ],
    [
        "nombre" => "Pruebas"
    ],
    
];

$mueble1 = new MuebleBase("Mitzoker");
echo $mueble1."<br>".PHP_EOL;

$mueble1 = new MuebleBase("Estoker", "abcabcabcdNoeNoeNoeOieOIeOieiaia", "Dinamarca", 2013, "01/12/2014", "09/09/2022", 50.5);
echo $mueble1."<br>".PHP_EOL;


//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbicacion);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>
    
<?php
}
