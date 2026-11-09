<?php

class MuebleBase {

    //CONSTANTES
    public const MAXIMO_MUEBLES = 50;

    //PROPIEDADES
    private string $_nombre;
    private string $_fabricante = "";
    private string $_pais = "ESPAÑA";
    private int $_anio = 2020;
    private string $_fechaIniVenta = "01/01/2020";
    private string $_fechaFinVenta = "31/12/2040";
    private float $_precio = 30;

    //VARIABLE DE CLASE
    private static int $_mueblesCreados = 0;

    public function __construct(string $nom, string $fabri = "", string $pais = "ESPAÑA",
                                int $year = 2020, string $fechaInicio = "01/01/2020",
                                string $fechaFin = "31/12/2040", float $precio = 30) 
    {
        
    }

    //getters y setters
    public function getNombre() : string {
        return $this -> _nombre;
    }

    public function getFabricante() : string {
        return $this -> _fabricante;
    }

    public function getPais() : string {
        return $this -> _pais;
    }

    public function getAnio() : int {
        return $this -> _anio;
    }

    public function getFechaIniVenta() : string {
        return $this -> _fechaIniVenta;
    }

    public function getFechaFinVenta() : string {
        return $this -> _fechaFinVenta;
    }

    public function getPrecio() : float {
        return $this -> _precio;
    }

    //--
    public function setNombre(string $nuevoNombre) : bool {

        if (!validaCadena($nuevoNombre, 40, "Nombre")) {
            return false;
        }

        if ($nuevoNombre == "") {
            return false;
        }

        $nuevoNombre = mb_strtoupper($nuevoNombre);
        return true;
    }

    public function setFabricante(string $nuevoFabricante) : bool {

        if (!validaCadena($nuevoFabricante, 30, "FaMu:")) {
            return false;
        }

        //si ya empieza por FaMu:
        if (!substr($nuevoFabricante, 0, 5) == "FaMu:")
            $nuevoFabricante = "FaMu:" . $nuevoFabricante;

        //recortamos a 30 si se pasa
        if (mb_strlen($nuevoFabricante) > 30) {
            $nuevoFabricante = mb_substr($nuevoFabricante, 0, 30);
        }
        
        return true;
    }

    public function setPais(string $nuevoPais) : bool {

        if (!validaCadena($nuevoPais, 20, "ESPAÑA")) {
            return false;
        }
        
        return true;
    }

    public function setAnio(int $nuevoAnio) : bool {

        $hoy = time();
        $anioActual = date("Y", $hoy);

        if (!validaEntero($nuevoAnio, 2020, $anioActual, 2020)) {
            return false;
        }
        
        return true;
    }

    public function setFechaIniVenta(string $nuevaFecha) : bool {

        $fechaLimite = new DateTime("01-01-".$this->getAnio());

        //construimos fecha con año de fabricación (1 de enero)
        if (!validaFecha($nuevaFecha, "01/01/2020")) { //si la nuevaFecha es incorrecta

            return false;
        }
        else { //si la nuevaFecha es correcta
            
            $partesFecha = mb_split("/", $nuevaFecha);
            $dia = $partesFecha[0];
            $mes = $partesFecha[1];
            $anio = $partesFecha[2]; 

            $nuevaFechaDate = new DateTime($dia."-".$mes."-".$anio);

            if ($fechaLimite < $nuevaFechaDate) { //si $fechaLimite es menor está bien
                return true;
            }
            else { //en caso de fallo:
                $nuevaFecha = "01/01/". $this->getAnio();
                return false;
            }
        }
    }

    public function setFechaFinVenta(string $nuevaFechaFin) : bool {

        $partesFecha = mb_split("/", $this->getFechaIniVenta());
        $dia = $partesFecha[0];
        $mes = $partesFecha[1];
        $anio = $partesFecha[2]; 

        $fechaLimite = new DateTime($dia."-".$mes."-".$anio);

        //
        if (!validaFecha($nuevaFechaFin, "31/12/2040")) { //si la nuevaFecha es incorrecta

            return false;
        }
        else { //si la nuevaFecha es correcta
            
            $partesFechaFin = mb_split("/", $nuevaFechaFin);
            $diaFin = $partesFechaFin[0];
            $mesFin = $partesFechaFin[1];
            $anioFin = $partesFechaFin[2]; 

            $nuevaFechaFinDate = new DateTime($diaFin."-".$mesFin."-".$anioFin);

            if ($fechaLimite < $nuevaFechaFinDate) { //si $fechaLimite es menor está bien
                return true;
            }
            else { //en caso de fallo le ponemos fecha por defecto:
                
                return false;
            }
        }
    }

    public function setPrecio(float $precio) : bool {
            
        if (!validaReal($precio, 30, 10000, 30)) { //si la nuevaFecha es incorrecta

            return false;
        }

        return true;
    }

    
    //PARA QUE NO TENGA SOBRECARGA DINÁMICA DE PROPIEDADES:
    //métodos mágicos para control de la sobrecarga
    public function __set(string $name, mixed $value):void {
        throw new \Exception("La propiedad $name no existe");
        
    }

    public function __get(string $name):mixed {
        throw new \Exception("La propiedad $name no existe");
    }

    public function __isset(string $name):bool
    {
        //throw new \Exception('Not implemented');
        return false;
    }

    public function __unset(string $name):void
    {
        //throw new \Exception('Not implemented');
        ;
    }


}