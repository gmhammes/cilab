<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Equipamento.php
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Cor extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Cor'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
    }

    public function index() {
        redirect($this->controller . '/listar');
    }

    private function llhc() {
        $this->loadLibrary();
        $this->loadHelper();
        $this->loadModel();
        return(NULL);
    }

    private function loadLibrary() {
        $this->load->library('dc');
        $this->load->library('pagination');
        //$this->load->library('');
        return(NULL);
    }

    private function loadHelper() {
        // $this->load->helper('', '');
        return(NULL);
    }

    private function loadModel() {
        //$this->load->model('', ''); //('Model_form', 'form')
        $this->load->model('Model_crud', 'crud');
        return(NULL);
    }

    public function listar($offset = NULL) {
        $this->load->library('table');
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Cores';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Lista de Cor';
        $this->dados['my_dados_DB'][0]['tabela'] = $this->crud->read('tab_cor', array('str_nome != ' => ''), '`str_nome` ASC', $offset, $this->dados['limit']);
        $this->load->view('index/index', $this->dados);
        return(NULL);
        // $this->dc->ep($this->dados['my_dados_DB'][0]['tabela']);
    }

}
