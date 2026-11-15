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

$errores = [

];

$datos = [];

$id = 0;

if (isset($_GET["indice"])) {
    $id = intval($_GET["indice"]);
}

$muebleSeleccionado = $muebles[$id];

if (isset($_POST["confirmar"])) {

    $obCopia = clone $muebleSeleccionado;

    if (isset($_POST["nombre"])) {

        $nombre = mb_trim($_POST["nombre"]);
        if ($obCopia->setNombre($nombre)) {
            $datos["Nombre"] = $nombre;
            
        }
        else {
            $errores["nombre"] = "Nombre incorrecto";
        }


        if (isset($_POST["nombre"])) {

        $nombre = mb_trim($_POST["nombre"]);
        if ($obCopia->setNombre($nombre)) {
            $datos["Nombre"] = $nombre;
            
        }
        else {
            $errores["nombre"] = "Nombre incorrecto";
        }

    }
    }
}



//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbicacion);
cuerpo($muebles, $errores, $datos, $id); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $muebles, array $errores, array $datos, int $id)
{
?>
    <br><br>
    <h1>MI TIENDA</h1>

    
    

<br>   
<?php
    formulario($muebles, $errores, $id);
    //resumen
    muestraResumen($datos);

    




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
function formulario(array $datosMuebles, array $errores, int $id) {

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
        <input name="nombre" type="text" value="<?php echo $datosMuebles[$id]->getNombre() ?>">
        <br>
        <!-- Fabricante Mueble -->
        <label for="">Fabricante: </label>
        <input name="fabricante" type="text" value="<?php echo $datosMuebles[$id]->getFabricante() ?>">
        <br>
        <!-- Pais Mueble -->
        <label for="">País: </label>
        <input name="pais" type="text" value="<?php echo $datosMuebles[$id]->getPais() ?>">
        <br>
        <!-- Anio Mueble -->
        <label for="">Año: </label>
        <input name="anio" type="text" value="<?php echo $datosMuebles[$id]->getAnio() ?>">
        <br>
        <!-- FechaIniVenta Mueble -->
        <label for="">FechaIniVenta: </label>
        <input name="fechaIniVenta" type="text" value="<?php echo $datosMuebles[$id]->getFechaIniVenta() ?>">
        <br>
        <!-- FechaFinVenta Mueble -->
        <label for="">FechaFinVenta: </label>
        <input name="fechaFinVenta" type="text" value="<?php echo $datosMuebles[$id]->getFechaFinVenta() ?>">
        <br>
        <!-- Precio Mueble -->
        <label for="">Precio: </label>
        <input name="precio" type="text" value="<?php echo $datosMuebles[$id]->getPrecio() ?>">
        <br>
        <!-- PorcentajeReciclado Mueble -->
        <?php 

            if (get_class($datosMuebles[$id]) == "MuebleReciclado") {
                ?>
                <label for="">Porcentaje Reciclado: </label>
                <input name="porcentajeReciclado" type="text" value="<?php echo $datosMuebles[$id]->getPorcentajeReciclado() ?>">
                <?php
            }
            if (get_class($datosMuebles[$id]) == "MuebleTradicional") {
                ?>
                <label for="">Peso: </label>
                <input name="peso" type="text" value="<?php echo $datosMuebles[$id]->getPeso() ?>">
                <label for="">Serie: </label>
                <input name="serie" type="text" value="<?php echo $datosMuebles[$id]->getSerie() ?>">
                <?php
            }
        ?>
        
        <br>
        <button type="submit" name="confirmar">Confirmar</button>
    </form>
    <?php
}

