<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Autenticar extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Autenticar'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
    }

    public function index() {
        redirect($this->controller . '/logar');
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

    public function logar() {
        $this->load->model('Model_form', 'form');
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Laborat&oacute;rio - Logon';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Logon';
        $this->dados['dadosFormOpen'] = $this->controller . '/autenticar';
        $this->dados['my_dados_DB']['agrupamentoFields'][0] = $this->crud->groupBy('tab_construct', 'str_agrupamento', array('str_aplicacao' => 'Autentica-Logar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['select']['str_sistema'] = $this->crud->read('tab_sistemas', array(NULL), 'str_sistema ASC');
        $this->dados['my_dados_DB']['form'][0] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Autentica-Logar'), 'str_tab_index ASC', $limit = 1);
        $this->load->view('index/index', $this->dados);
        // $this->dc->ep($this->dados['dadosEstilo']);
        return(NULL);
    }

    private function validarAutenticar() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_login', 'LOGIN', 'trim|required');
        $this->form_validation->set_rules('str_senha', 'SENHA', 'trim|required');
        $this->form_validation->set_rules('str_sistema', 'SISTEMA', 'trim|required');
    }

    public function autenticar() {
        $this->validarAutenticar();
        $colunas = $this->crud->nomeColunas('tab_usuario');
        $extras = array('password_change');
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        $this->dc->ep($dadosPOST, TRUE);
        if ($this->form_validation->run() == TRUE) {
            if (isset($dadosPOST['password_change'])) {
                $usuario = $this->crud->read('tab_usuario', array('str_login' => $dadosPOST['str_login'], 'str_senha' => md5($dadosPOST['str_senha']), 'str_sistema' => $dadosPOST['str_sistema']));
                ($usuario['result'] == NULL) ? (redirect($this->controller . '/logar/change-password-off')) : (NULL);
                if ($usuario['result'][0]->str_senha) {
                    $this->dc->ep($usuario, TRUE);
                    $dadosPOST['str_senha'] = md5($dadosPOST['password_change']);
                    $dadosPOST['password_change'] = NULL;
                    $dadosPOST = array_filter($dadosPOST);
                    $update = $this->crud->update('tab_usuario', $dadosPOST, array('str_pk_usuario', $usuario['result'][0]->str_pk_usuario), $limit = 1);
                    ($update['result'] == 1) ? (redirect($this->controller . '/logar/change-password-on')) : (redirect($this->controller . '/logar/change-password-off'));
                    //$this->dc->ep($update);
                }
            } else {
                $usuario = $this->crud->read('tab_usuario', array('bol_bloqueado' => 'N', 'str_login' => $dadosPOST['str_login'], 'str_senha' => md5($dadosPOST['str_senha']), 'str_sistema' => $dadosPOST['str_sistema']), NULL, $limit = 1);
                $this->dc->ep($dadosPOST, TRUE);
                $this->dc->ep($usuario, TRUE);
                ($usuario['result'] == NULL) ? (redirect($this->controller . '/logar/login-off')) : (redirect($this->controller . '/criaSessao/' . $usuario['result'][0]->str_pk_usuario));
            }
        } else {
            $this->dados['erro'] = utf8_encode(validation_errors("<p>", "</p>"));
            $this->dados['dadosEstilo']['titulo_pagina'] = 'Laborat&oacute;rio - Logon';
            $this->dados['dadosEstilo']['titulo_aplicacao'] = 'Logon';
            $this->dados['dadosFormOpen'] = $this->controller . '/autenticar';
            $this->dados['my_dados_DB']['agrupamentoFields'][0] = $this->crud->groupBy('tab_construct', 'str_agrupamento', array('str_aplicacao' => 'logar'));
            $this->dados['my_dados_DB']['form']['select']['str_sistema'] = $this->crud->read('tab_sistemas', array(NULL), 'str_sistema ASC');
            $this->dados['my_dados_DB']['form'][0] = $this->crud->read('tab_construct', array('str_aplicacao' => 'logar'), 'str_tab_index ASC', $limit = 1);
            $this->load->view('index/index', $this->dados);
        }
        return(NULL);
    }

    public function criaSessao($chave = NULL) {
        $usuario = $this->crud->read('tab_usuario', array('str_pk_usuario' => $chave));
        $dados = (array) $usuario['result'][0];
        $this->dc->ep($dados, TRUE);
        $novosdados = array(
            'logado' => TRUE,
            'str_pk_logon' => $this->dados['str_chave'],
            'str_sistema' => $dados['str_sistema'],
            'str_pk_usuario' => $dados['str_pk_usuario'],
            'bol_bloqueado' => $dados['bol_bloqueado'],
            'str_nome' => $dados['str_nome'],
            'str_login' => $dados['str_login'],
            'str_responsavel' => $dados['str_responsavel'],
            'dtm_data' => date('Y-m-d'),
            'dtm_hora' => date('H:i:s')
        );
        $this->dc->ep($novosdados, TRUE);
        /* Inserir sessao */
        $this->session->set_userdata($novosdados);
        $this->dc->ep($this->session->userdata('str_nome'), TRUE);
        $sistema = (isset($dados['str_sistema'])) ? ($dados['str_sistema']) : ($this->dados['sistema']);
        $cookie = array(
            'name' => 'sistema',
            'value' => $sistema,
            'expire' => 86500,
            'secure' => false
        );
        $this->input->set_cookie($cookie);
        $this->dc->ep($this->input->cookie('sistema', false), TRUE);
        redirect('Index' . '/resumo/login-on');
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('autenticar/logar', $this->dados);
    }

    public function senha($string = NULL) {
        $this->dc->ep($this->dados['str_chave'], TRUE);
        echo md5(NULL);
        echo "<br />";
        echo md5($string);
        return ($string);
    }

}
