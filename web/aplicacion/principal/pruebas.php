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

    // //$mueble1 -> antiguedad = 2;
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

    //clase MuebleReciclado:
    // $mueble1 = new MuebleReciclado("Mitzokker");
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleReciclado("Mitzok", porReciclado: 60);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleReciclado("Mitzok", porReciclado: 60);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleReciclado("Mitzok", porReciclado: 60);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleReciclado("Mitzok", porReciclado: 60);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1->setPorcentaje(100);
    // echo $mueble1."<br>".PHP_EOL;
    // foreach ($mueble1->damePropiedadesAdicionales() as $prop)
    //     echo $prop."<br>".PHP_EOL;

    //clase MuebleTradicional:
    // $mueble1 = new MuebleTradicional("Mitzokker");
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleTradicional("Mitzok", peso: 14);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleTradicional("Mitzok", peso: 250);
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleTradicional("Mitzok", serie: "S02");
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1 = new MuebleTradicional("Mitzok", peso: 50, serie: "S03");
    // echo $mueble1."<br>".PHP_EOL;
    // $mueble1->antiguedad = "2";
    // $mueble1->setPeso(100);
    // echo $mueble1."<br>".PHP_EOL;
    // foreach ($mueble1->damePropiedadesAdicionales() as $prop)
    //     echo $prop."<br>".PHP_EOL;

    //clase Caracteristicas:
    $objetoCarac = new Caracteristicas();

    $objetoCarac->color = "rosa";
    echo $objetoCarac->color."<br>".PHP_EOL;
    $objetoCarac->material = "plástico";
    echo $objetoCarac->material."<br>".PHP_EOL;
    $objetoCarac->longitud = 38;
    echo $objetoCarac->longitud."<br>".PHP_EOL;
    $objetoCarac->ULTIMA = "ultimaProp";
    echo $objetoCarac->ULTIMA."<br>".PHP_EOL;
    //esta de saludo no se permite:
    //$objetoCarac->saludo = "hola";
    //echo $objetoCarac->saludo."<br>".PHP_EOL;

    //después de poner ULTIMA, se pueden editar las propiedas
    $objetoCarac->longitud = 50;
    echo $objetoCarac->longitud."<br>".PHP_EOL;

    // $objetoCarac->saludo = "hola";
    // echo $objetoCarac->saludo."<br>".PHP_EOL;

    if (isset($objetoCarac->ULTIMA)) {
        echo "No se permiten más propiedades"."<br>".PHP_EOL;
    }

    unset($objetoCarac->ULTIMA);

    $objetoCarac->despedida = "adiós";
    echo $objetoCarac->despedida."<br>".PHP_EOL;

    $cadena = "";
    foreach ($objetoCarac as $key => $value) {

        $cadena .= $key . ": " . $value . "; <br>".PHP_EOL;
    }

    echo $cadena;

    echo $objetoCarac. "; <br>".PHP_EOL;

    //método anadirCaracteristicas:
    $mueble1 = new MuebleTradicional("Mitzok", peso: 50, serie: "S03");
    echo $mueble1."<br>".PHP_EOL;

    $mueble1->anadirCaracteristicas("saliente", true, "precio", 300);

    echo $mueble1;

    //probar luego y también probar si no le paso un string a anadirCaracteristicas




}
