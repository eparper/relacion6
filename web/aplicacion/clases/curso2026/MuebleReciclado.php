<?php 

final class MuebleReciclado extends MuebleBase {

    private int $_porcentajeReciclado = 10;

    
    public function __construct(string $nom, string $fabri = "", string $pais = "ESPAÑA", 
                                int $year = 2020, string $fechaInicio = "01/01/2020", 
                                string $fechaFin = "31/12/2040", float $precio = 30, int $porReciclado = 10)
    {
        parent::__construct($nom, $fabri, $pais, $year, $fechaInicio, $fechaFin, $precio);

        $this->setPorcentaje($porReciclado);

    }

    public function getPorcentaje() : int {
        return $this->_porcentajeReciclado;
    }

    public function setPorcentaje(int $porc) : bool {

        if (!validaEntero($porc, 0, 100, 10)) {
            return false;
        }
        
        $this->_porcentajeReciclado = $porc;
        return true;
    }


    public function damePropiedadesAdicionales() : Array {

        $arr = [];

        $arr[] = "porcentajeReciclado";

        return $arr;

    }

    
    public function __toString()
    {
        return parent::__toString() . ". Porcentaje reciclado: " . $this->getPorcentaje();
    }
}