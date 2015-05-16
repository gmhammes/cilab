<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Usuario extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Usuario'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
    }

    public function index() {
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
        return(NULL);
    }

    public function cadastrar() {
        $this->load->model('Model_form', 'form');
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Laborat&oacute;rio - Cadastrar';
        $this->dados['dadosEstilo']['titulo_aplicacao'] = 'Cadastrar';
        $this->dados['dadosFormOpen'] = $this->controller . '/insert';
        $this->dados['my_dados_DB']['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', array('str_aplicacao' => 'Usuario'));
        $this->dados['my_dados_DB']['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Usuario'), 'str_tab_index ASC');
        $this->load->view('index/index', $this->dados);
        //$this->dc->ep($this->dados);
        return(NULL);
    }

    public function validarCadastrar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_nome', 'NOME', 'trim|required');
        $this->form_validation->set_rules('str_login', 'LOGIN', 'trim|required');
        $this->form_validation->set_rules('str_senha', 'SENHA', 'trim|required');
        $this->form_validation->set_rules('confirm_password', 'CONFIRMA&Ccedil;&Atilde;O do PASSWORD', 'trim|required');
    }

    public function insert() {
        $this->validarCadastrar();
        $colunas = $this->crud->nomeColunas('tab_usuario');
        $extras = array('confirm_password');
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        //$this->dc->ep($dadosPOST, TRUE);
        //$this->dc->ep($elementos);
        if ($this->form_validation->run() == TRUE) {
            ($dadosPOST['str_senha'] == $dadosPOST['confirm_password']) ? (NULL) : (redirect($this->controller . '/cadastrar/password-off'));
            $dadosPOST['confirm_password'] = NULL;
            $dadosPOST['str_senha'] = md5($dadosPOST['str_senha']);
            $dadosPOST = array_filter($dadosPOST);
            $this->crud->create('tab_usuario', $dadosPOST);
            redirect($this->controller . '/cadastrar/insert-ok');
        } else {
            $this->dados['erro'] = utf8_encode(validation_errors("<p>", "</p>"));
            $this->dados['dadosEstilo']['titulo_pagina'] = 'Laborat&oacute;rio - Logon';
            $this->dados['dadosEstilo']['titulo_aplicacao'] = 'Usuário';
            $this->dados['dadosFormOpen'] = $this->controller . '/insert';
            $this->dados['my_dados_DB']['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', array('str_aplicacao' => 'Usuario'));
            $this->dados['my_dados_DB']['form'] = $this->crud->read('tab_construct', 65, 0, array('str_aplicacao' => 'Usuario'), 'str_tab_index ASC');
            $this->load->view('index/index', $this->dados);
        }
    }

}
