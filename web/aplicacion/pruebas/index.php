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


    // $mueble1 = new MuebleBase("Mitzoker");
    // echo $mueble1."<br>".PHP_EOL;

    // $mueble1 = new MuebleBase("Estoker", "abcabcabcdNoeNoeNoeOieOIeOieiaia", "Dinamarca", 2023, "20/02/2021", "09/09/2023", 50.5);
    // echo $mueble1."<br>".PHP_EOL;

    // echo $mueble1 -> getFechaIniVenta();
    // $mueble1->setAnio(2021);
    // $mueble1 = new MuebleBase("Mitzzoker");
    // echo $mueble1;

    // $numero = 0;


    // echo "<br><br>".$numero;

    // //$mueble1 -> $antiguedad;
    // $mueble1 = new MuebleBase("Mitzokerr");
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleBase("Mitzooker");
    // echo $mueble1."<br>".PHP_EOL;


    //este ya no se podrá crear:
    // $mueble1 = new MuebleBase("Mitzokker");
    // echo $mueble1."<br>".PHP_EOL;
    // MuebleBase::puedeCrear($numero);
    // echo "<br><br>".$numero;
    //$mueble1 = new MuebleBase("Mitzoker");
}
