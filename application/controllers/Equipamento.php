<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Equipamento extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Equipamento'); // Dados Controller (dc)
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
        $this->load->library('pagination');
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
        $this->dados['metodo'] = 'listar';
        $this->load->library('table');
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Equipamento';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Listar Equipamento Ativos';
        $this->dados['dadosEstilo'][1]['titulo_aplicacao'] = 'Listar Equipamento Desativados';
        $this->dados['my_dados_DB']['tabela'][0]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento-Cadastrar', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['tabela'][1]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento-Cadastrar', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['tabela'][0]['conteudo'] = $this->crud->read('tab_equipamento', $where = array('str_sistema' => $this->sistema, 'bol_ativo' => 'Y'), '`dtm_data` DESC, `dtm_hora` DESC', $offset, $this->dados['limit']);
        $this->dados['my_dados_DB']['tabela'][1]['conteudo'] = $this->crud->read('tab_equipamento', $where = array('str_sistema' => $this->sistema, 'bol_ativo' => 'N'), '`dtm_data` DESC, `dtm_hora` DESC', $offset, $this->dados['limit']);
        $this->load->view('index/index', $this->dados);
        return(NULL);
    }

    public function cadastrar() {
        ($this->session->userdata('logado') == TRUE)?(NULL):(redirect($this->controller . '/listar'));
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Equipamento';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Cadastrar Equipamento';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/insert';
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Equipamento-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['select']['str_tipo_objeto'] = $this->crud->read('tab_tipo_objeto', NULL, 'str_tipo_objeto ASC');
        $this->dados['my_dados_DB']['select']['str_marca'] = $this->crud->read('tab_marca', NULL, 'str_marca ASC');
        $this->dados['my_dados_DB']['select']['str_modelo'] = $this->crud->read('tab_modelo', NULL, 'str_modelo ASC');
        $this->load->view('index/index', $this->dados);
    }

    public function validarInsert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_pk_equipamento', 'CHAVE do EQUIPAMENTO', 'trim|required');
        $this->form_validation->set_rules('str_n_serie', 'Nº SÉRIE', 'trim|required');
    }

    public function insert() {
        $this->validarInsert();
        $colunas = $this->crud->nomeColunas('tab_equipamento');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        (isset($dadosPOST['bol_ativo'])) ? (NULL) : ($dadosPOST['bol_ativo'] = 'N');
        if ($this->form_validation->run() == TRUE) {
            echo count($dadosPOST);
            $this->dc->ep($dadosPOST, TRUE);
            $this->crud->create('tab_equipamento', $dadosPOST);
            redirect('/' . $this->controller . '/fechar/cadastro-ok/' . $dadosPOST['str_pk_equipamento'], 'refresh');
        } else {
            redirect('/' . $this->controller . '/fechar/cadastro-off/');
        }
    }

    public function atualizar($str_pk_equipamento = NULL) {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Equipamento';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Atualizar Equipamento';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/update/' . $str_pk_equipamento;
        $this->dados['my_dados_DB'][0]['atualizar'] = $this->crud->read('tab_equipamento', $where = array('str_pk_equipamento' => $str_pk_equipamento));
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Equipamento-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['select']['str_tipo_objeto'] = $this->crud->read('tab_tipo_objeto', NULL, 'str_tipo_objeto ASC');
        $this->dados['my_dados_DB']['select']['str_marca'] = $this->crud->read('tab_marca', NULL, 'str_marca ASC');
        $this->dados['my_dados_DB']['select']['str_modelo'] = $this->crud->read('tab_modelo', NULL, 'str_modelo ASC');
        ($this->uri->segment(4) == 'pop') ? ($this->load->view('index/pop', $this->dados)) : ($this->load->view('index/index', $this->dados));
    }

    //$this->dc->ep($str_pk_equipamento);

    public function validarUpdate() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_pk_equipamento', 'CHAVE do EQUIPAMENTO', 'trim|required');
        $this->form_validation->set_rules('str_n_serie', 'Nº SÉRIE', 'trim|required');
    }

    public function update($str_pk_equipamento = NULL) {
        $this->validarUpdate();
        $colunas = $this->crud->nomeColunas('tab_equipamento');
        $extras = array('bol_ativo');
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        (isset($dadosPOST['bol_ativo'])) ? ($dadosPOST['bol_ativo']) : ($dadosPOST['bol_ativo'] = 'N');
        if ($this->form_validation->run() == TRUE) {
            echo count($dadosPOST);
            $this->dc->ep($dadosPOST, TRUE);
            $this->crud->update('tab_equipamento', $dadosPOST, array('str_pk_equipamento', $str_pk_equipamento), $limit = 1);
            redirect('/' . $this->controller . '/fechar/' . $dadosPOST['str_pk_equipamento'] . '/listar-ok/', 'refresh');
        }
    }

    public function desativar($str_pk_equipamento = NULL) {
        $dadosPOST['str_pk_equipamento'] = $str_pk_equipamento;
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
