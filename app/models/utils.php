<?php

    /**
     * Obtiene valor enviado por POST
     *
     * @param $valor string Valor a obtener
     * @return mixed|string Valor que se quiere obtener, si existe.
     */
    function vp($valor) {
        return (isset($_POST[$valor])) ? $_POST[$valor] : '';
    }

    /**
     * Obtiene valor enviado por GET
     *
     * @param $valor string Valor a obtener
     * @return mixed|string Valor que se quiere obtener, si existe.
     */
    function vg($valor) {
        return (isset($_GET[$valor])) ? $_GET[$valor] : '';
    }

    /**
     * Obtiene todos los valores que existen en array $_POST
     * @return array Valores en POST
     */
    function todos_vp() {
        $valores_post = [];

        foreach ($_POST as $campo => $valor) {
            if (vp($campo)) {
                $valores_post[$campo] = $valor;
            }
        }

        return $valores_post;
    }

    /**
     * Obtiene todos los valores que existen en array $_POST
     * @return array Valores en GET
     */
    function todos_vg() {
        $valores_get = [];

        foreach ($_GET as $campo => $valor) {
            if (vg($campo)) {
                $valores_get[$campo] = $valor;
            }
        }

        return $valores_get;
    }
?>