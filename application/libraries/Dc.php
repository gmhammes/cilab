<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Dc {

    private $controller;
    private $sistema;

    public function setController($controller) {
        $this->controller = $controller;
    }

    public function getController() {
        return ($this->controller);
    }

    public function setSistema($sistema) {
        $this->sistema = $sistema;
    }

    public function getSistema() {
        return ($this->sistema);
    }

    public function my_dados_controller() {
        $dados = array(
            'controller' => $this->getController(),
            'sistema' => $this->getSistema(),
            'erro' => $this->erro(),
            'limit' => $this->limit(),
            'alerta' => $this->alerta(),
            'dadosEstilo' => $this->my_dados_estilo(),
            'formulario' => $this->formulario(),
            'str_chave' => $this->my_database_chave(),
            'my_dados_DB' => $this->my_dados_DB(),
            'my_caminho_view' => $this->my_caminho_view(),
        );
        return($dados);
    }

    private function erro() {
        $erro = NULL;
        return($erro);
    }

    private function alerta() {
        $alerta = NULL;
        return($alerta);
    }

    private function my_dados_DB() {
        $my_dados_DB = array(
            NULL
        );
        return($my_dados_DB);
    }

    function my_database_chave() {
        $var_l = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'J', 'L', 'M', 'N', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'X', 'Z');
        $var_n = array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9);
        $rand_l1 = $var_l[rand(0, 20)];
        $rand_l2 = $var_l[rand(0, 20)];
        $rand_n1 = $var_n[rand(0, 9)];
        $rand_n2 = $var_n[rand(0, 9)];
        $value = (string) date('YmdHis') . $rand_l1 . $rand_n1 . $rand_l2 . $rand_n2;
        /**/
        return($value);
    }

    private function my_caminho_view() {
        $my_caminho_view = array(
            'str_view' => 'index/index',
        );
        return($my_caminho_view);
    }

    private function limit() {
        $limit = 65;
        return($limit);
    }

    private function my_dados_estilo() {
        $dadosEstilo = array(
            'caminho_css' => 'assets/css/',
            'arquivos_css' => array('pagina', 'form_colunas', 'menu', 'tabela', 'legend', 'titulos', 'calendar'),
            'img_top_titulo' => ($this->getSistema() !== NULL) ? ($this->getSistema()) : ('todos'),
            'titulo_pagina' => '$this->dados[dadosEstilo][titulo_pagina]',
            'titulo_aplicacao' => '$this->dados[dadosEstilo][titulo_aplicacao]',
        );
        return($dadosEstilo);
    }

    private function formulario() {
        $formulario = array(
            'formOpen' => current_url(),
            'formSubmit' => 'Enviar'
        );
        return($formulario);
    }

    public function ep($expression = NULL, $exit = NULL) {
        if (($expression !== NULL) && ($exit == NULL)) {
            $this->exibeDadosExit($expression);
        } elseif (($expression !== NULL) && ($exit !== NULL)) {
            $this->exibeDados($expression);
        } else {
            exit("Valor de EP n&atilde;o encontrado");
        }
        return(NULL);
    }

    public function exibeDados($expression) {
        echo "<br />";
        echo "<pre>";
        print_r($expression);
        echo "</pre>";
        echo "<br />";
        return(NULL);
    }

    public function exibeDadosExit($expression) {
        echo "<br />";
        echo "<pre>";
        print_r($expression);
        echo "</pre>";
        echo "<br />";
        echo "<br />";
        exit("FIM dos dados Solicitados!!");
        return(NULL);
    }

    public function preparaLike($value) {
        $value = str_replace(' ', '%', $value);
        $value = str_replace(';', '', $value);
        $value = str_replace('.', '%', $value);
        $value = str_replace(',', '', $value);
        $value = str_replace('-', '', $value);
        $value = str_replace('+', '', $value);
        $value = str_replace('=', '', $value);
        $value = str_replace('_', '', $value);
        $value = str_replace('@', '%', $value);
        $value = str_replace('#', '', $value);
        $value = str_replace('$', '', $value);
        $value = str_replace('&', '', $value);
        $value = str_replace('*', '', $value);
        $value = str_replace('?', '', $value);
        $value = str_replace('!', '', $value);
        $value = str_replace('(', '', $value);
        $value = str_replace(')', '', $value);
        $value = str_replace('[', '', $value);
        $value = str_replace(']', '', $value);
        $value = str_replace('{', '', $value);
        $value = str_replace('}', '', $value);
        return($value);
    }

    function imprimeDecimal($valor = NULL) {
        $caracteres_invalidos = array("/", "\"", "?", "%", "*", ":", "|", "<", ">", ".");
        if (!$valor) {
            return (false);
        }
        foreach ($caracteres_invalidos as $caractere) {
            if (strrpos($valor, $caractere))
                return (false);
        }
        //$retorno = "R$ ".$valor . ",00";
        $retorno = 'R$ ' . number_format($valor, 2, ',', '.');
        return ($retorno);
    }

}