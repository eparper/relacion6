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

if (isset($_POST["mostrar"])) {

    if (isset($_POST["selectMuebles"])) {
        $indiceMueble = $_POST["selectMuebles"];
        $muebleSeleccionado = $muebles[$indiceMueble];

        $datos["Nombre"] = $muebleSeleccionado->getNombre();
        $datos["Fabricante"] = $muebleSeleccionado->getFabricante();
        $datos["Pais"] = $muebleSeleccionado->getPais();
        $datos["Año"] = $muebleSeleccionado->getAnio();
        $datos["FechaIniVenta"] = $muebleSeleccionado->getFechaIniVenta();
        $datos["FechaFinVenta"] = $muebleSeleccionado->getFechaFinVenta();
        $datos["Precio"] = $muebleSeleccionado->getPrecio();
        //propiedades adicioinales
        foreach ($muebleSeleccionado->damePropiedadesAdicionales() as $prop) {
            
            $datos[$prop] = $muebleSeleccionado->{"get".$prop}(); //depende de la propiedad (getPeso, getSerie...)
        }

        //caracts adicionales -- getCaracteristicas devuelve un objeto Caracteristicas
        foreach ($muebleSeleccionado->getCaracteristicas() as $clave => $valor) {
            
            $datos[$clave] = $valor;
        }
        

    }
}



if (isset($_POST["modificar"])) {


    if (isset($_POST["selectMuebles"])) {

        $indice = $_POST["selectMuebles"];
    }

    header("Location: modificar.php?indice=$indice");
}

//dibuja la plantilla de la vista
inicioCabecera("TIENDA");
cabecera();
finCabecera();
inicioCuerpo("TIENDA", $barraUbicacion);
cuerpo($muebles, $errores, $datos); //llamo a la vista
finCuerpo();
// **********************************************************
//vista
function cabecera() {}
//vista
function cuerpo(array $muebles, array $errores, array $datos)
{
?>
    <br><br>
    <h1>MI TIENDA</h1>

    <table class="miTabla">
    <thead>
        <tr>
            <th>Índice mueble</th>
            <th>Tipo mueble</th>
            <th>Nombre mueble</th>
            <th>País</th>
            <th>Fabricante</th>
        </tr>
    </thead>

    <tbody>
        <?php 

            foreach ($muebles as $indice => $valor) {
                ?> 
                <tr>
                    <td><?= $indice ?></td>
                    <td><?= get_class($valor) ?></td>
                    <td><?= $valor->getNombre() ?></td>
                    <td><?= $valor->getPais() ?></td>
                    <td><?= $valor->getFabricante() ?></td>

                </tr>
                <?php
            }

            
            ?>
    </tbody>
</table>
<br>   
<?php
    formulario($muebles, $errores);
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
function formulario(array $datosMuebles, array $errores) {

    if ($errores) {   //mostrar los errores 
        echo "<div class='error'>";
        foreach ($errores as $clave => $valor) {
            foreach ($valor as $error)
                echo "$clave => $error<br>" . PHP_EOL;
        }
        echo "</div>";
    }
    ?>

    <form action="" method="post">
        
        <input type="submit" class="boton" value="Mostrar mueble" name="mostrar">
        <input type="submit" class="boton" value="Modificar mueble" name="modificar">

        <select name="selectMuebles">
            <?php
                foreach ($datosMuebles as $indice => $valor) {
                    ?> 
                        
                        <option value="<?php echo $indice ?>">
                            <?php echo $indice . " " .$valor->getNombre(). " ". get_class($valor) ?>
                        </option>

                    <?php
                }
            ?>
            
        </select>
    </form>

    <?php
}

