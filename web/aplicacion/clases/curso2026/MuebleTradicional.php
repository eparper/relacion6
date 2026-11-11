<?php

final class MuebleTradicional extends MuebleBase {

    private float $_peso = 15;
    private string $_serie = "S01";

    public function __construct(string $nom, string $fabri = "", string $pais = "ESPAÑA", 
                                int $year = 2020, string $fechaInicio = "01/01/2020", 
                                string $fechaFin = "31/12/2040", float $precio = 30, 
                                float $peso = 15, string $serie = "S01")
    {
        parent::__construct($nom, $fabri, $pais, $year, $fechaInicio, $fechaFin, $precio);

        $this->setPeso($peso);
        $this->setSerie($serie);

    }

    public function getPeso() : float {
        return $this->_peso;
    }

    public function getSerie() : string {
        return $this->_serie;
    }

    public function setPeso(float $peso): bool {

        if (!validaReal($peso, 15, 300, 15)) {
            return false;
        }
        
        $this->_peso = $peso;
        return true;
    }

    public function setSerie(string $serie): bool {

        if (!validaCadena($serie, 3, "S01")) {
            return false;
        }
        
        $this->_serie = $serie;
        return true;
    }

    public function damePropiedadesAdicionales() : Array {

        $arr = [];

        $arr[] = "peso";
        $arr[] = "serie";

        return $arr;

    }

    public function __toString()
    {
        return parent::__toString() . ". Peso: " . $this->getPeso() . ", serie: " . $this->getSerie();
    }

}