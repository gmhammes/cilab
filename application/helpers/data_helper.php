<?php

if (!function_exists('dataPT_BR')) {

    function dataPT_BR($valor) {
        $newDate = date("d-m-Y", strtotime($valor));
        return($newDate);
    }

}

if (!function_exists('calculaDatas')) {

    function calculaDatas($data_final = NULL, $data_inicial = NULL) {
        // Usa a função strtotime() e pega o timestamp das duas datas:
        $time_inicial = strtotime($data_inicial);
        $time_final = strtotime($data_final);
        // Calcula a diferença de segundos entre as duas datas:
        $diferenca = $time_final - $time_inicial; // 19522800 segundos
        // Calcula a diferença de dias
        $dias = (int) floor($diferenca / (60 * 60 * 24)); // 225 dias
        // Exibe uma mensagem de resultado:
        return($dias);
    }

}

if (!function_exists('dataExtenso')) {

    function dataExtenso($data = NULL) {
        header('Content-Type: text/html; charset=iso-8859-1');
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
        //$retorno = strftime('%A, %d de %B de %Y', strtotime($data));
        $retorno = strftime('%d de %B de %Y', strtotime($data));
        return($retorno);
    }

}
?> 