<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barraUbicacion = [
    [
        "nombre" => "Inicio",
        "url" => "/index.php"
    ],
    [
        "nombre" => "Tienda"
    ],
    
];

$errores = [];

$datos = []; //aquí se guardan los datos del mueble modificado

$id = 0;
$obCopia = null;
$sw = false;

//índice que llega de la otra página
if (isset($_GET["indice"])) {
    $id = intval($_GET["indice"]);
}

$muebleSeleccionado = $muebles[$id];

if (isset($_POST["confirmar"])) {

    $obCopia = clone $muebleSeleccionado; //hacemos la copia

    if (isset($_POST["nombre"])) {

        //nombre
        $nombre = mb_trim($_POST["nombre"]);
        if ($obCopia->setNombre($nombre)) {
            $datos["Nombre"] = $nombre;
            
        }
        else {
            $errores["nombre"][] = "Nombre incorrecto";
        }
    }


    //Fabricante
    if (isset($_POST["fabricante"])) {

        $nombre = mb_trim($_POST["fabricante"]);
        if ($obCopia->setFabricante($nombre)) {
            $datos["Fabricante"] = $nombre;
            
        }
        else {
            $errores["fabricante"][] = "Fabricante incorrecto";
        }

    }

    //País
    if (isset($_POST["pais"])) {

        if ($_POST["pais"] == "") {
            $errores["pais"][] = "Introduce un país";
        }

        $nombre = mb_trim($_POST["pais"]);
        if ($obCopia->setPais($nombre)) {
            $datos["pais"] = $nombre;
            
        }
        else {
            $errores["pais"][] = "País incorrecto";
        }

    }

    //País
    if (isset($_POST["anio"])) {

        $nombre = intval($_POST["anio"]);
        if ($obCopia->setAnio($nombre)) {
            $datos["anio"] = $nombre;
            
        }
        else {
            $errores["anio"][] = "Año incorrecto";
        }

    }

    //fechaIniVenta
    if (isset($_POST["fechaIniVenta"])) {

        $nombre = mb_trim($_POST["fechaIniVenta"]);
        if ($obCopia->setFechaIniVenta($nombre)) {
            $datos["fechaIniVenta"] = $nombre;
            
        }
        else {
            $errores["fechaIniVenta"][] = "FechaIniVenta incorrecta";
        }

    }

    //fechaFinVenta
    if (isset($_POST["fechaFinVenta"])) {

        $nombre = mb_trim($_POST["fechaFinVenta"]);
        if ($obCopia->setFechaFinVenta($nombre)) {
            $datos["fechaFinVenta"] = $nombre;
            
        }
        else {
            $errores["fechaFinVenta"][] = "FechaFinVenta incorrecta";
        }

    }

    //precio
    if (isset($_POST["precio"])) {

        $nombre = floatval($_POST["precio"]);
        if ($obCopia->setPrecio($nombre)) {
            $datos["precio"] = $nombre;
            
        }
        else {
            $errores["precio"][] = "Precio incorrecto";
        }

    }

    //porcentajeReciclado
    if (isset($_POST["porcentajeReciclado"])) {

        if ($_POST["porcentajeReciclado"] == "") {
            $errores["porcentajeReciclado"][] = "Introduce un porcentaje de reciclado";
        }

        $nombre = intval($_POST["porcentajeReciclado"]);
        if ($obCopia->setPorcentajeReciclado($nombre)) {
            $datos["porcentajeReciclado"] = $nombre;
            
        }
        else {
            $errores["porcentajeReciclado"][] = "porcentajeReciclado incorrecto";
        }

    }

    //peso
    if (isset($_POST["peso"])) {

        $nombre = floatval($_POST["peso"]);
        if ($obCopia->setPeso($nombre)) {
            $datos["peso"] = $nombre;
            
        }
        else {
            $errores["peso"][] = "Peso incorrecto";
        }

    }

    //serie
    if (isset($_POST["serie"])) {

        if ($_POST["serie"] == "") {
            $errores["serie"][] = "Serie vacía";
        }

        $nombre = trim($_POST["serie"]);
        if ($obCopia->setSerie($nombre)) {
            $datos["serie"] = $nombre;
            
        }
        else {
            $errores["serie"][] = "Serie incorrecta";
        }

    }


    //para que no se borre entero el formulario:
    //muebleSeleccionado es el que está guardado en la página del formulario
    $muebleSeleccionado = $obCopia;


    if (!$errores)  //no hay errores hago la insercion 
    {

        $muebles[$id] = $obCopia;
        
        
    }
    else {
        $sw = true; //hay errores
    }


}



//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbicacion);
cuerpo($errores, $datos, $muebleSeleccionado, $sw); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $errores, array $datos, MuebleBase $mueble, bool $sw)
{
?>
    <br><br>
    <h1>MI TIENDA</h1>

    
    

<br>   
<?php
    

    formulario($errores, $mueble);
    if (!$sw) { //si NO hay errores
        //resumen
        muestraResumen($datos);
    }

    ?>
    <br>
    <a href="index.php" name="enlaceIndex">Volver a index</a>
    <?php




}

function muestraResumen(array $datosMueble) {

    foreach ($datosMueble as $clave => $valor) {
        echo $clave . ": " . $valor . "<br>".PHP_EOL;
    }
    
}


/**
 * Función que muestra el formulario
 *
 * @param array $datos Array donde se le pasan todos los datos con posiciones asociativas
 * @param array $errores Matriz donde se le pasan los errores
 * @return void
 */
function formulario(array $errores, MuebleBase $mueble) {

    if ($errores) {   //mostrar los errores 
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }

    ?>
    <form action="" method="POST">

        <!-- Nombre Mueble -->
        <label for="">Nombre: </label>
        <input name="nombre" type="text" value="<?php echo $mueble->getNombre() ?>">
        <br>
        <!-- Fabricante Mueble -->
        <label for="">Fabricante: </label>
        <input name="fabricante" type="text" value="<?php echo $mueble->getFabricante() ?>">
        <br>
        <!-- Pais Mueble -->
        <label for="">País: </label>
        <input name="pais" type="text" value="<?php echo $mueble->getPais() ?>">
        <br>
        <!-- Anio Mueble -->
        <label for="">Año: </label>
        <input name="anio" type="text" value="<?php echo $mueble->getAnio() ?>">
        <br>
        <!-- FechaIniVenta Mueble -->
        <label for="">FechaIniVenta: </label>
        <input name="fechaIniVenta" type="text" value="<?php echo $mueble->getFechaIniVenta() ?>">
        <br>
        <!-- FechaFinVenta Mueble -->
        <label for="">FechaFinVenta: </label>
        <input name="fechaFinVenta" type="text" value="<?php echo $mueble->getFechaFinVenta() ?>">
        <br>
        <!-- Precio Mueble -->
        <label for="">Precio: </label>
        <input name="precio" type="text" value="<?php echo $mueble->getPrecio() ?>">
        <br>
        <!-- PorcentajeReciclado Mueble -->
        <?php 

            if ($mueble instanceof MuebleReciclado) {
                ?>
                <label for="">Porcentaje Reciclado: </label>
                <input name="porcentajeReciclado" type="text" value="<?php echo $mueble->getPorcentajeReciclado() ?>">
                <?php
            }
            if ($mueble instanceof MuebleTradicional) {
                ?>
                <label for="">Peso: </label>
                <input name="peso" type="text" value="<?php echo $mueble->getPeso() ?>">
                <label for="">Serie: </label>
                <input name="serie" type="text" value="<?php echo $mueble->getSerie() ?>">
                <?php
            }
        ?>
        
        <br>
        <button type="submit" name="confirmar">Confirmar</button>
    </form>

    
    
    <?php
}

