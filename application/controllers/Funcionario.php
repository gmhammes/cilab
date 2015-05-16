<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Funcionario extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Funcionario'); // Dados Controller (dc)
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
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Funcionário';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Listar Funcionário Ativos';
        $this->dados['dadosEstilo'][1]['titulo_aplicacao'] = 'Listar Funcionário Desativados';
        $this->dados['my_dados_DB']['tabela'][0]['conteudo'] = $this->crud->read('tab_funcionario', $where = array('str_sistema' => $this->sistema, 'bol_ativo' => 'Y'), '`dtm_data` DESC, `dtm_hora` DESC', $offset, $this->dados['limit']);
        $this->dados['my_dados_DB']['tabela'][1]['conteudo'] = $this->crud->read('tab_funcionario', $where = array('str_sistema' => $this->sistema, 'bol_ativo' => 'N'), '`dtm_data` DESC, `dtm_hora` DESC', $offset, $this->dados['limit']);
        $this->dados['my_dados_DB']['tabela'][0]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario-Cadastrar', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['tabela'][1]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario-Cadastrar', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->load->view('index/index', $this->dados);
        return(NULL);
    }

    public function cadastrar() {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Funcionário';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Cadastrar Funcionário';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/Insert';
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Funcionario-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['select']['str_telefone_list'] = $this->crud->read('tab_funcionario_telefone', array('str_pk_funcionario' => ''), 'str_telefone ASC');
        $this->load->view('index/index', $this->dados);
    }

    public function validarInsert() {
        // $this->form_validation->set_rules('campo', 'MENSAGEM', 'trim|required|is_unique[tab_funcionario.str_cpf]');
        $this->form_validation->set_rules('str_pk_funcionario', 'CHAVE do FUNCIONARIO', 'trim|required');
        $this->form_validation->set_rules('str_id_matricula', 'ID ou MATRÍCULA', 'trim|required|is_unique[tab_funcionario.str_id_matricula]');
        $this->form_validation->set_rules('str_nome', 'ID ou MATRÍCULA', 'trim|required');
    }

    public function insert() {
        $this->validarInsert();
        $colunas = $this->crud->nomeColunas('tab_funcionario');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $elementos['str_telefone_list'] = NULL;
        $dadosPOST = array_filter($elementos);
        $this->dc->ep($dadosPOST, TRUE);
        if ($this->form_validation->run() == TRUE) {
            $this->dc->ep($dadosPOST, TRUE);
            $this->crud->create('tab_funcionario', $dadosPOST);
            redirect('/' . $this->controller . '/atualizar/' . $dadosPOST['str_pk_funcionario'] . "/cadastro-ok", 'refresh');
        } else {
            $this->dados['erro'] = utf8_encode(validation_errors("<p>", "</p>"));
            $this->dados['dadosEstilo']['titulo_pagina'] = 'Funcionário';
            $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Cadastrar Funcionário';
            $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/Insert';
            $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Funcionario'), 'str_tab_index ASC');
            $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario'), 'str_tab_index ASC');
            $this->load->view('index/index', $this->dados);
        }
    }

    public function atualizar($str_pk_equipamento = NULL) {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Funcionário';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Atualizar Funcionário';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/Validar';
        $this->dados['my_dados_DB'][0]['atualizar'] = $this->crud->read('tab_funcionario', $where = array('str_pk_funcionario' => $str_pk_equipamento));
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Funcionario-Cadastrar'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario-Cadastrar'), 'str_tab_index ASC');
        $ep = $this->dados['my_dados_DB']['select']['str_telefone_list'] = $this->crud->read('tab_funcionario_telefone', array('str_pk_funcionario' => $str_pk_equipamento), 'str_telefone ASC');
        ($this->uri->segment(4) == 'pop') ? ($this->load->view('index/pop', $this->dados)) : ($this->load->view('index/index', $this->dados));
        // $this->dc->ep($ep);
    }

    public function cadastraChave() {
        $this->load->model('Model_funcioanrio', 'funcioanrio');
        $this->dc->ep($this->dados['str_chave'], TRUE);
        $this->dados['my_dados_DB'] = $this->funcioanrio->chaveamento($this->dados['str_chave']);
    }

}
