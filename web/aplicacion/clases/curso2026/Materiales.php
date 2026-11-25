<?php 

/**
 * Enumeración de Estado Civil (enum backed)
 */
enum Materiales : int { 
    case MADERA = 5; 
    case HIERRO = 10; 
    case CRISTAL = 15; 
    case PLASTICO = 20; 
 
    //es una clase y se pueden definir sus propios métodos 

    /**
     * Método para que devuelva el nombre de cada caso
     *
     * @return string Devuelve el nombre
     */
    function descripcion() : string { 
        return $this->name; 
    } 

    /**
     * Método para que devuelva el valor de cada caso
     *
     * @return integer Devuelve el valor
     */
    function valor() : int { 
        return $this->value; 
    } 

    /**
     * Método que devuelve array con todos los casos.
     *
     * @return array devuelve el array con los casos
     */
    static function casos() : array { 

        return self::cases(); 
    } 
} 