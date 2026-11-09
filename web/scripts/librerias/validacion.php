<?php


/**
 * Función que valida si un entero está entre un valor mínimo y un valor máximo
 *
 * @param integer $var El número a comprobar
 * @param integer $min El valor mínimo del rango a comprobar
 * @param integer $max El valor máximo del rango a comprobar
 * @param integer $defecto El valor por defecto que se le pone a $var cuando hay algún problema
 * @return boolean devuelve true si todo ha ido bien y false cuando no ha ido bien
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool {

    $opciones = [
        "options" => [
            "min_range" => $min,
            "max_range" => $max
        ]
    ];


    $resultadoBien = filter_var($var, FILTER_VALIDATE_INT, $opciones);

    if ($resultadoBien) {
        $var = $resultadoBien;
        return true;
    }
    else {
        $var = $defecto;
        return false;
    }
    
}


/**
 * Función que valida si un real está entre un valor mínimo y un valor máximo
 *
 * @param integer $var El número a comprobar
 * @param integer $min El valor mínimo del rango a comprobar
 * @param integer $max El valor máximo del rango a comprobar
 * @param integer $defecto El valor por defecto que se le pone a $var cuando hay algún problema
 * @return boolean devuelve true si todo ha ido bien y false cuando no ha ido bien
 */
function validaReal(int &$var, int $min, int $max, int $defecto):bool {

    $opciones = [
        "options" => [
            "min_range" => $min,
            "max_range" => $max
        ]
    ];


    $resultadoBien = filter_var($var, FILTER_VALIDATE_FLOAT, $opciones);

    if ($resultadoBien) {
        $var = $resultadoBien;
        return true;
    }
    else {
        $var = $defecto;
        return false;
    }
}

/**
 * Función que valida una fecha
 *
 * @param string $var Fecha en string para validarla
 * @param string $defecto Si ha habido algún error, pone este valor por defecto
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaFecha(string &$var, string $defecto):bool  {

    //separamos el día, mes y año
    $fecha = mb_split("/", $var); 

    //mes -- día -- año
    $fechaBien = checkdate($fecha[1], $fecha[0], $fecha[2]);

    if ($fechaBien) {

        //construimos una fecha
        $fechaDate = mktime(0, month: $fecha[1], day: $fecha[0], year: $fecha[2]);

        //saneamos día y mes si tienen 1 cifra
        $var = date("d/m/Y", $fechaDate); //devuelve string

        return true;

    }
    else {

        $var = $defecto;
        return false;
    }


}

/**
 * Función que valida una hora
 *
 * @param string $var hora en string para validarla
 * @param string $defecto Si ha habido algún error, pone este valor por defecto
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaHora(string &$var, string $defecto):bool {

    $horaBien = true;

    //separamos en hora, minutos y segundos
    $hora = mb_split(":", $var); 

    //hora, minutos y segundos
    if ($hora[0] > 23) { //horas
        $horaBien = false;
    }
    if ($hora[1] > 59) { //minutos
        $horaBien = false;
    }
    if ($hora[2] > 59) { //segundos
        $horaBien = false;
    }

    if ($horaBien) {

        //construimos una hora
        $horaDate = mktime($hora[0], $hora[1], $hora[2]);

        //saneamos la hora
        $var = date("H:i:s", $horaDate); //devuelve string

        return true;

    }
    else {

        $var = $defecto;
        return false;
    }
}

/**
 * Función que valida un email
 *
 * @param string $var Email en string a validar
 * @param string $defecto Si ha habido algún error, pone este valor por defecto
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaEmail(string &$var, string $defecto):bool {

    $resultadoBien = filter_var($var, FILTER_VALIDATE_EMAIL);

    if ($resultadoBien) {
        $var = $resultadoBien;
        return true;
    }
    else {
        $var = $defecto;
        return false;
    }
}

/**
 * Función que valida si una cadena tiene la longitud permitida
 *
 * @param string $var Cadena a validar
 * @param integer $longitud Longitud máxima permitida
 * @param string $defecto Cadena por defecto si ha ido mal o ha habido algún fallo
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaCadena(string &$var, int $longitud, string $defecto):bool {

    if (mb_strlen($var) < $longitud) {
        $var = (string) $var;
        return true;
    }
    else {
        $var = $defecto;
        return false;
    }
}

/**
 * Función que comprueba una expresión en una cadena
 *
 * @param string $var Cadena donde se va a comprobar la expresión
 * @param string $expresion Expresión regular para comprobar si la cadena cumple con ella
 * @param string $defecto Valor por defecto en caso de fallo
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaExpresion(string &$var, string $expresion, string $defecto):bool {

    $opciones = [
        "options" => [
            "regexp" => $expresion
        ]
    ];

    $resultadoBien = filter_var($var, FILTER_VALIDATE_REGEXP, $opciones);

    if ($resultadoBien) {
        $var = $resultadoBien;
        return true;
    }
    else {
        $var = $defecto;
        return false;
    }
}

/**
 * Función que dice si un valor está o en los índices del array pasado,
 * o en los valores del array pasado.
 *
 * @param mixed $var Valor a comprobar si está o no
 * @param array $posibles Array en el que vamos a comprobar si está el valor
 * @param integer $tipo 1 si quieres comprobar en los valores, 2 si quieres comprobar en las claves
 * @return boolean Devuelve true si ha ido bien, devuelve false si ha ido mal
 */
function validaRango(mixed $var, array $posibles, int $tipo=1):bool {

    $resultado = false;

    //contenido
    if ($tipo == 1) {

        if (in_array($var, $posibles)) {
            $resultado = true;
        }
        else
            $resultado = false;


    }
    //claves
    if ($tipo == 2) {
        if (array_key_exists($var, $posibles)) {
            $resultado = true;
        }
        else
            $resultado = false;
    }

    return $resultado;
}