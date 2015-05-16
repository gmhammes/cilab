<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Marca extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Marca'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
    }

    public function index() {
        $this->marca->insertSelect();
        $this->marca->upper();
        redirect($this->controller . '/cadastrar');
    }

    private function llhc() {
        $this->loadLibrary();
        $this->loadHelper();
        $this->loadModel();
        return(NULL);
    }

    private function loadLibrary() {
        $this->load->library('dc');
        return(NULL);
    }

    private function loadHelper() {
        // $this->load->helper('', '');
        $this->load->helper('form');
        return(NULL);
    }

    private function loadModel() {
        //$this->load->model('', ''); //('Model_form', 'form')
        $this->load->model('Model_crud', 'crud');
        $this->load->model('Model_marca', 'marca');
        return(NULL);
    }

    public function cadastrar() {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Equipamento';
        $this->dados['dadosEstilo']['titulo_aplicacao'] = 'Cadastrar Marca do Equipamento';
        $this->dados['dadosFormOpen'] = $this->controller . '/Validar';
        $this->dados['my_dados_DB']['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Equipamento-Marca'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['form'][0] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento-Marca'), 'str_tab_index ASC');
        $this->load->view('index/pop', $this->dados);
    }

    //$this->dc->ep($this->dados['str_chave']);
}
