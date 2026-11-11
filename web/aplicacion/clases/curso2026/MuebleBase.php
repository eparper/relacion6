<?php

require_once RUTABASE . "/scripts/librerias/validacion.php";

abstract class MuebleBase {

    //CONSTANTES
    public const MAXIMO_MUEBLES = 5;

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
        //si se ha superado el máximo de muebles creados
        if (self::$_mueblesCreados >= self::MAXIMO_MUEBLES) {
            throw new Exception("No se permite la creación del mueble");
        }

        
        if ($this->setNombre($nom) == false) {
            throw new Error("Error en el nombre");
        }
        else {
            $this->setNombre($nom);
        }
            

        $this->setFabricante($fabri);
        $this->setPais($pais); 
        $this->setAnio($year);  
        $this->setFechaIniVenta($fechaInicio);
        $this->setFechaFinVenta($fechaFin);
        $this->setPrecio($precio);
        

        self::$_mueblesCreados++;

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
        $this->_nombre = $nuevoNombre;
        return true;
    }

    public function setFabricante(string $nuevoFabricante) : bool {

        // if (!validaCadena($nuevoFabricante, 30, "FaMu:")) {
        //     return false;
        // }

        //si ya empieza por FaMu:
        if (substr($nuevoFabricante, 0, 5) !== "FaMu:")
            $nuevoFabricante = "FaMu:" . $nuevoFabricante;

        //recortamos a 30 si se pasa
        if (mb_strlen($nuevoFabricante) > 30) {
            $nuevoFabricante = mb_substr($nuevoFabricante, 0, 30);
        }
        
        $this->_fabricante = $nuevoFabricante;
        return true;
    }

    public function setPais(string $nuevoPais) : bool {

        if (!validaCadena($nuevoPais, 20, "ESPAÑA")) {
            return false;
        }
        
        $this->_pais = $nuevoPais;
        return true;
    }

    public function setAnio(int $nuevoAnio) : bool {

        $hoy = time();
        $anioActual = date("Y", $hoy);

        if (!validaEntero($nuevoAnio, 2020, $anioActual, 2020)) {
            return false;
        }
        
        $this->_anio = $nuevoAnio;
        return true;
    }

    public function setFechaIniVenta(string $nuevaFecha) : bool {

        $fechaLimite = new DateTime("01-01-".$this->getAnio());

        //construimos fecha con año de fabricación (1 de enero)
        if (!validaFecha($nuevaFecha, "")) { //si la nuevaFecha es incorrecta

            $nuevaFecha = "01/01/". $this->getAnio();
            $this->_fechaIniVenta = $nuevaFecha;
            return false;
        }
        else { //si la nuevaFecha es correcta
            
            $partesFecha = mb_split("/", $nuevaFecha);
            $dia = $partesFecha[0];
            $mes = $partesFecha[1];
            $anio = $partesFecha[2]; 

            $nuevaFechaDate = new DateTime($dia."-".$mes."-".$anio);

            if ($fechaLimite < $nuevaFechaDate) { //si $fechaLimite es menor está bien

                $this->_fechaIniVenta = $nuevaFecha;
                return true;
            }
            else { //en caso de fallo:
                $nuevaFecha = "01/01/". $this->getAnio();
                $this->_fechaIniVenta = $nuevaFecha;
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
        if (!validaFecha($nuevaFechaFin, "")) { //si la nuevaFecha es incorrecta

            return false;
        }
        else { //si la nuevaFecha es correcta
            
            $partesFechaFin = mb_split("/", $nuevaFechaFin);
            $diaFin = $partesFechaFin[0];
            $mesFin = $partesFechaFin[1];
            $anioFin = $partesFechaFin[2]; 

            $nuevaFechaFinDate = new DateTime($diaFin."-".$mesFin."-".$anioFin);

            if ($fechaLimite < $nuevaFechaFinDate) { //si $fechaLimite es menor está bien
                $this->_fechaFinVenta = $nuevaFechaFin;
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

        $this->_precio = $precio;
        return true;
    }

    abstract public function damePropiedadesAdicionales() : Array;

    public static function puedeCrear(int &$numero) : bool {

        //si todavía se pueden crear muebles:
        if (self::$_mueblesCreados < self::MAXIMO_MUEBLES) {

            //devolvemos en $numero el número de muebles que aún se pueden crear
            $numero = self::MAXIMO_MUEBLES - self::$_mueblesCreados;
            return true;
        }
        else
            return false;
        
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

    public function __toString()
    {
        return "MUEBLE de clase ". get_class($this) .
                " con nombre ". $this->getNombre().
                ", fabricante ". $this->getFabricante() .
                ", fabricado en ". $this->getPais() .
                " a partir del año ". $this->getAnio() .
                ", vendido desde ". $this->getFechaIniVenta() .
                " hasta ". $this->getFechaFinVenta() .
                ", precio " . $this->getPrecio();
    }


}