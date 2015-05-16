<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Telefone.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Telefone extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Telefone'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
        $this->rastreamento();
    }

    public function index() {
        redirect($this->controller . '/listar');
    }

    public function fechar() {
        ($this->uri->segment(3) == 'cadastro-ok') ? ($alerta = "Cadastro realizado com sucesso!") : (NULL);
        if ($alerta !== NULL) {
            echo "<SCRIPT LANGUAGE=" . '"' . "JavaScript" . '"' . " TYPE=" . '"' . "text/javascript" . '"' . ">";
            echo "alert (" . '"' . "{$alerta}" . '"' . ");";
            echo "</script>";
        }
        echo '<script> window.close(); </script>';
        return(NULL);
    }

    private function llhc() {
        $this->loadLibrary();
        $this->loadHelper();
        $this->loadModel();
        return(NULL);
    }

    private function loadLibrary() {
        $this->load->library('dc');
        $this->load->library('form_validation');
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

    private function rastreamento() {
        $novosdados = array(
            'str_pk_rastreamento' => $this->dados['str_chave'],
            'str_pk_logon' => $this->session->userdata('str_pk_logon'),
            'str_sistema' => $this->session->userdata('str_sistema'),
            'str_pk_usuario' => $this->session->userdata('str_pk_usuario'),
            'bol_bloqueado' => $this->session->userdata('bol_bloqueado'),
            'str_nome' => $this->session->userdata('str_nome'),
            'str_login' => $this->session->userdata('str_pk_logon'),
            'str_url_comando' => current_url(),
            'str_responsavel' => $this->session->userdata('str_responsavel'),
            'dtm_data' => date('Y-m-d'),
            'dtm_hora' => date('H:i:s')
        );
        $this->crud->create('tab_rastreamento', $novosdados);
        // $this->dc->ep($novosdados);
        return(NULL);
    }

    public function listar($offset = NULL) {
        return(NULL);
    }

    public function cadastrar() {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Telefone';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Cadastrar Telefone';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/insert';
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Telefone-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Telefone-Cadastrar'), 'str_tab_index ASC');
        $this->load->view('index/pop', $this->dados);
    }

    public function validarInsert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_pk_funcionario_telefone', 'CHAVE do TELEFONE', 'trim|required');
        $this->form_validation->set_rules('str_pk_funcionario', 'CHAVE do FUNCIONÁRIO', 'trim|required');
    }

    public function insert() {
        $this->validarInsert();
        $colunas = $this->crud->nomeColunas('tab_funcionario_telefone');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        (isset($dadosPOST['bol_ativo'])) ? (NULL) : ($dadosPOST['bol_ativo'] = 'N');
        if ($this->form_validation->run() == TRUE) {
            echo count($dadosPOST);
            $this->dc->ep($dadosPOST, TRUE);
            $this->crud->create('tab_funcionario_telefone', $dadosPOST);
            redirect('/' . $this->controller . '/fechar/cadastro-ok/', 'refresh');
        } else {
            redirect('/' . $this->controller . '/fechar/cadastro-off/');
        }
    }

    public function atualizar($str_pk_equipamento = NULL) {
        return (NULL);
    }

    //$this->dc->ep($str_pk_equipamento);

    public function validarUpdate() {
        return(NULL);
    }

    public function update($str_pk_equipamento = NULL) {
        return(NULL);
    }

    public function desativar($str_pk_funcionario_telefone = NULL) {
        $dadosPOST['str_pk_funcionario_telefone'] = $str_pk_funcionario_telefone;
        $dadosPOST['bol_ativo'] = 'N';
        $this->dc->ep($dadosPOST, TRUE);
        $result = $this->crud->update('tab_equipamento', $dadosPOST, array('str_pk_equipamento', $str_pk_equipamento), $limit = 1);
        redirect('/' . $this->controller . '/fechar/' . $dadosPOST['str_pk_equipamento'] . '/desativado-ok/', 'refresh');
        return(NULL);
    }

    public function cadastraChave() {
        $this->load->model('Model_equipamento', 'equipamento');
        $this->dc->ep($this->dados['str_chave'], TRUE);
        $this->dados['my_dados_DB'] = $this->equipamento->chaveamento($this->dados['str_chave']);
    }

}
