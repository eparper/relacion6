<?php

function paginaError($mensaje)
{
  header("HTTP/1.0 404 $mensaje");
  inicioCabecera("PRACTICA");
  finCabecera();
  inicioCuerpo("ERROR");
  echo "<br />\n";
  echo $mensaje;
  echo "<br />\n";
  echo "<br />\n";  echo "<br />\n";
  echo "<a href='/index.php'>Ir a la pagina principal</a>\n";
  
  finCuerpo();  
}

function inicioCabecera($titulo)
{
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">

        <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
        Remove this if you use the .htaccess -->
            <meta http-equiv="X-UA-Compatible"  content="IE=edge,chrome=1">

        <title><?php echo $titulo ?></title>
        <meta name="description" content="">
        <meta name="author" content="Administrador">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
        <link rel="shortcut icon" href="/favicon.ico">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">
        
        <link rel="stylesheet" type="text/css" href="/estilos/base.css">
<?php
}

function finCabecera()
{
?>
    </head>
<?php   
}

function inicioCuerpo(string $cabecera, array $barraUbicacion = [])
{
    global $acceso;

?>
    <body>
        <div id="documento">
        
            <header>
                <a href="/index.php"><img src="../../imagenes/logo.png" alt="icono" class="icono"></a>
                <h1 id="titulo"><?php echo $cabecera;?></h1>
            </header>
            
            <div id="barraLogin">
                
            </div>
            <div id="barraMenu">
                <ul>
                    <li><a href="/index.php">Inicio</a></li>
                    <li><a href="/aplicacion/pruebas/index.php">A rellenar</a></li>
                    
                 </ul> 
                
            </div>
            <div id="barraUbicacion">
                
                <?php
                    //esta opción no es eficiente, habría que repetir código
                    // for ($cont = 0; $cont < count($barraUbicacion); $cont++) {
                        ?>
                        <?php 
                        //si es la última posición muestra solo el nombre sin enlace:
                            // if ($barraUbicacion[$cont] == $barraUbicacion[count($barraUbicacion) - 1]) {
                            //     echo $barraUbicacion[$cont]["nombre"];
                            // }
                            // else { ?>
                                <!-- <a href=" --><?php //echo $barraUbicacion[$cont]["url"];?><!--">--><?php //echo $barraUbicacion[$cont]["nombre"];?></a><?php
                            //}
                        ?>
                        
                        <?php
                    //}

                    //opción Vicente, se pueden poner más opciones de esta manera
                    foreach ($barraUbicacion as $elemento) {
                        ?>
                        <?php 
                        //
                            if (isset($elemento["url"])) {
                                echo "<a href = '{$elemento["url"]}' >";
                            }
                            echo $elemento["nombre"];

                            if (isset($elemento["url"])) {
                                echo "</a>";
                            }

                            //se pueden poner más opciones
                            if (isset($elemento["adicional"])) {
                                echo $elemento["adicional"];
                                
                            }
                            else {
                                echo "&nbsp;&nbsp;";
                            }
                
                            
                        ?>
                        
                        <?php
                    }
                ?>


            </div>
            <div>
<?php   
}

function finCuerpo()
{
?>
                <br />
                <br />
            </div>
            <footer>
                <hr width="90%"  />  
                <div>
                    Noemí Parejo
                </div>
            </footer>
        </div>
    </body>
</html>
<?php
}


