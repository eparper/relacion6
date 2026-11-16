<?php 

class Caracteristicas implements Iterator {

    private array $_caracts = [];


    //propiedades para iterar
    private int $_claveActual;


    /***************************************************** */
    //----------------PROPIEDADES DINÁMICAS--------------- */
    /***************************************************** */
    
    /**
     * Método mágico get: se llamará de forma automática cuando se lea 
     * una propiedad y no sea visible.
     *
     * @param string $nombre Nombre que se usa para leer la propiedad sobrecargada
     * @return void No devuelve nada porque lo que hace es leer la propiedad.
     */
    public function __get(string $nombre)
    {
        $arrayLetrasNums = ["a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", 
                            "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", 
                            "x", "y", "z", "A", "B", "C", "D", "E", "F", "G", "H", "I", 
                            "J", "K", "L", 
                        "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", 
                        "X", "Y", "Z", 0, 1, 2, 3, 4, 5, 6, 7, 8, 9];

        $cadAleatoria = "";

        for ($cont = 0; $cont < 15; $cont++) {

            //le restamos 1 porque intenta acceder a la posición 64 y solo hay del 0 al 63
            $numRandom = mt_rand(0, count($arrayLetrasNums) - 1);

            $cadAleatoria = $arrayLetrasNums[$numRandom];
        }

        if ($nombre == "numero_serie") {
            $this->_caracts["numero_serie"] = $cadAleatoria;
            return $this->_caracts["numero_serie"];
        }

        if (isset($this->_caracts[$nombre]))
            return $this->_caracts[$nombre];
        else
            //si no existe lanza una excepción 
            throw new Exception("No existe la propiedad $nombre");
    }

    /**
     * Método mágico set: se llamará de forma automática cuando se escriba 
     * una propiedad y no sea visible 
     *
     * @param string $nombre Nombre de la propiedad a modificar
     * @param mixed $valor Valor para que se modifique la propiedad
     */
    public function __set(string $nombre, mixed $valor)
    {
        
        // if (isset($this->_caracts["numero_serie"])) {

        // }

        if (validaRango("ULTIMA", $this->_caracts, 2)) {

            //si ULTIMA está en el array y si se quiere modificar una propiedad existente 
            if (validaRango($nombre, $this->_caracts, 2)) {
                //creo/actualizo la variable dinámica. 
                $this->_caracts[$nombre] = $valor;
            }
            else {
                throw new Exception("No se permiten más propiedades dinámicas.");
            }
            
        }
        else { //si no está última, sigue añadiendo propiedades
            //creo/actualizo la variable dinámica. 
            $this->_caracts[$nombre] = $valor;
        }
        
    }
    
    
    /**
     * Método mágico isset: se llamará automáticamente al 
     * ejecutar isset o empty
     *
     * @param string $nombre Nombre de la propiedad a comprobar si existe
     * @return boolean Devuelve true si existe o false si no.
     */
    public function __isset(string $nombre): bool
    {
        return (isset($this->_caracts[$nombre]));
    }

    

    /**
     * Método mágico unset: se llamará automáticamente al ejecutar unset 
     * Elimina la propiedad
     *
     * @param string $nombre Nombre de la propiedad a eliminar.
     */
    public function __unset(string $nombre)
    {
        unset($this->_caracts[$nombre]);
    }

    /***************************************************** */
    //----------------ITERATOR---------------------------- */
    /***************************************************** */


    /**
     * Pone el puntero al valor inicial
     *
     * @return void No devuelve nada
     */
    public function rewind() : void
    { 
        $this->_claveActual = count($this->_caracts) - 1; 
        
        
    } 
     
    
    /**
     * Devuelve el contenido correspondiente a la posición actual (el valor)
     * 
     * @return mixed Devuelve el contenido o valor
     */
    public function current() : mixed
    { 
        
        return array_values($this->_caracts)[$this->_claveActual];
    } 
     
    
    /**
     * Devuelve la clave correspondiente a la posicion actual (la clave)
     *
     * @return mixed Devuelve la clave
     */
    public function key() : mixed
    { 
    
        return array_keys($this->_caracts)[$this->_claveActual];
    } 
     
    
    /**
     * Mueve el puntero a la siguiente posicion
     *
     * @return void No devuelve nada
     */
    public function next() : void
    {
        
        $this->_claveActual--; 
    } 
     
    

    /**
     * Comprueba si la posición actual es valida 
     *
     * @return boolean Devuelve true si es válida la claveActual o false si no lo es
     */
    public function valid() : bool
    { 
        //no se pone = al comparar porque claveActual solo llegaría 0,1,2,3, no llega al 4
        return validaEntero($this->_claveActual, 0, count($this->_caracts)-1, $this->_claveActual);  //le sumamos las dos propiedades privada y publica
    }

    public function __toString() : string
    {
        $cadena = "";
        
        foreach ($this->_caracts as $key => $value) {
            $cadena .= $key . ": " . $value . "; ";
        }

        return $cadena;
    }


}