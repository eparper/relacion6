<?php

class MuebleBase {

    //CONSTANTES
    public const MAXIMO_MUEBLES = 50;

    //PROPIEDADES
    private string $_nombre;
    private string $_fabricante;
    private string $_pais = "ESPAÑA";
    private int $_anio;
    private string $_fechaIniVenta = "01/01/2020";
    private string $_fechaFinVenta = "31/12/2040";
    private float $_precio = 30;

    //VARIABLE DE CLASE
    private static int $_mueblesCreados = 0;

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
            mb_substr($nuevoFabricante, 0, 30);
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

    public function setFechaIniVenta(string $nuevoAnio) : bool {

        $hoy = time();
        $anioActual = date("Y", $hoy);

        if (!validaEntero($nuevoAnio, 2020, $anioActual, 2020)) {
            return false;
        }
        
        return true;
    }


}