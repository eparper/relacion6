<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador

$barraUbicacion = [
    [
        "nombre" => "Inicio"
    ]
    
];

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbicacion);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{
    ?>
    <!-- ESTO VA EN EL HEAD -->
    <?php
}

//vista
function cuerpo()
{
?>
    <br><br>
    
<?php
}
