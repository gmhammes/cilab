<?php

// Fazer clausula para verde devolucao
// C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Equipamento.php
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Termo extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('Termo'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
        $this->rastreamento();
    }

    public function index() {
        redirect($this->controller . '/novoTermo');
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
        //$this->load->library('');
        $this->load->library('table');
        $this->load->library('dc');
        $this->load->library('table');
        $this->load->library('pagination');
        return(NULL);
    }

    private function loadHelper() {
        // $this->load->helper('', '');
        $this->load->helper('form');
        $this->load->helper('my_form');
        return(NULL);
    }

    private function loadModel() {
        //$this->load->model('', ''); //('Model_form', 'form')
        $this->load->model('Model_crud', 'crud');
        $this->load->model('Model_termo', 'termo');
        $this->load->model('Model_funcionario', 'funcionario');
        $this->load->model('Model_equipamento', 'equipamento');
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
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Termos';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Termos de Responsabilidade';
        $this->dados['dadosEstilo'][1]['titulo_aplicacao'] = 'Termo de Devolução';
        $this->dados['my_dados_DB']['tabela'][0]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Listar-Termo', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['tabela'][1]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Listar-Termo', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['my_dados_DB']['tabela'][0]['conteudo'] = $this->crud->join(array('tab_termo', 'tab_termo_detalhe_funcionario', 'tab_termo_detalhe_equipamento'), 'str_pk_termo', $where = array('str_tipo_termo' => "(TR) TERMO DE RESPONSABILIDADE"), '`str_pk_chave_antiga` DESC', $this->dados['limit']);
        $this->dados['my_dados_DB']['tabela'][1]['conteudo'] = $this->crud->join(array('tab_termo', 'tab_termo_detalhe_funcionario', 'tab_termo_detalhe_equipamento'), 'str_pk_termo', $where = array('str_tipo_termo' => "(TD) TERMO DE DEVOLUÇÃO"), '`str_pk_chave_antiga` DESC', $this->dados['limit']);
        $this->load->view('index/index', $this->dados);
        //$this->dc->ep($this->dados);
        return(NULL);
    }

    public function exibir($str_pk_termo = NULL, $painel = NULL) {
        $this->dados['metodo'] = 'exibir';
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Termos';
        $this->dados['my_dados_DB']['tabela'][2]['campos'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Termo-Exibe-Equipamento', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $titulo = $this->dados['my_dados_DB']['tabela'][0]['conteudo'] = $this->crud->read('tab_termo', $where = array('str_pk_termo =' => $str_pk_termo), $order_by = 'dtm_data DESC', NULL, $limit = 1);
        $this->dados['my_dados_DB']['tabela'][1]['conteudo'] = $this->crud->read('tab_termo_detalhe_funcionario', $where = array('str_pk_termo' => $str_pk_termo), $order_by = 'dtm_data DESC');
        $this->dados['my_dados_DB']['tabela'][2]['conteudo'] = $this->crud->read('tab_termo_detalhe_equipamento', $where = array('str_pk_termo' => $str_pk_termo), $order_by = 'dtm_data DESC');
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = $titulo['result'][0]->str_tipo_termo;
        $this->load->view('index/pop', $this->dados);
        return(NULL);
        // $this->dc->ep($this->dados['my_dados_DB']['tabela']);
    }

    public function novoTermo($str_pk_termo = NULL) {
        $this->dc->ep($this->dados['str_chave'], TRUE);
        $str_pk_termo = ($str_pk_termo == NULL) ? ($this->dados['str_chave']) : ($str_pk_termo);
        redirect($this->controller . '/cadastrar' . '/' . $str_pk_termo . '/Y');
    }

    public function cadastrar($str_pk_termo, $novo = NULL) {
        if ($novo == 'Y') {
            $dadosPOST['str_pk_termo'] = $str_pk_termo;
            $dadosPOST['dtm_data'] = date('Y-m-d');
            $dadosPOST['dtm_hora'] = date('H-m-s');
            $this->crud->create('tab_termo', $dadosPOST);
        }
        $this->dados['my_dados_DB'][0]['atualizar'] = $this->crud->read('tab_termo', $where = array('str_pk_termo' => $str_pk_termo));
        $this->dados['my_dados_DB']['select']['str_tipo_termo'] = $this->crud->read('tab_tipo_termo', NULL, 'str_tipo_termo ASC');
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Termo';
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Cadastrar Termo';
        $this->dados['dadosFormOpen'][0]['form'] = $this->controller . '/filtro/' . $str_pk_termo;
        $this->dados['my_dados_DB'][0]['agrupamentoFields'] = $this->crud->groupBy('tab_construct', 'str_agrupamento', $where = array('str_aplicacao' => 'Termo-Cadastro'), 'str_tab_index ASC');
        $this->dados['my_dados_DB'][0]['form'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Termo-Cadastro'), 'str_tab_index ASC');
        $this->load->view('index/index', $this->dados);
    }

    public function validarInsert() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('str_pk_termo', 'CHAVE do TERMO', 'trim|required');
    }

    public function filtro($str_pk_termo = NULL) {
        $this->dados['dadosEstilo']['titulo_pagina'] = 'Termo - Filtro';
        $this->validarInsert();
        $colunas = $this->crud->nomeColunas('tab_termo');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        (isset($dadosPOST['bol_ativo'])) ? (NULL) : ($dadosPOST['bol_ativo'] = 'N');
        // $this->dc->ep($dadosPOST, TRUE);
        if ($this->form_validation->run() == TRUE) {
            $this->crud->update('tab_termo', $dadosPOST, array('str_pk_termo', $str_pk_termo), $limit = 1);
        }
        $this->dados['dadosEstilo'][0]['titulo_aplicacao'] = 'Funcionário(s)';
        $this->dados['dadosEstilo'][1]['titulo_aplicacao'] = 'Equipamento(s)';

        $colunas = $this->crud->nomeColunas('tab_funcionario');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $elementos['bol_ativo'] = NULL;
        $elementos['str_responsavel'] = NULL;
        $elementos['dtm_data'] = NULL;
        $elementos['dtm_hora'] = NULL;
        $dadosPOST = array_filter($elementos);
        $this->dados['my_dados_DB'][0]['tabela'] = $this->crud->like('tab_funcionario', $like = $dadosPOST);

        $colunas = $this->crud->nomeColunas('tab_equipamento');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $elementos['bol_ativo'] = NULL;
        $elementos['str_responsavel'] = NULL;
        $elementos['dtm_data'] = NULL;
        $elementos['dtm_hora'] = NULL;
        $dadosPOST = array_filter($elementos);
        $this->dados['my_dados_DB'][1]['tabela'] = $this->crud->like('tab_equipamento', $like = $dadosPOST);

        $colunas = $this->crud->nomeColunas('tab_termo');
        $extras = array();
        $result = array_merge($colunas, $extras);
        $elementos = elements($result, $this->input->post());
        $dadosPOST = array_filter($elementos);
        $this->crud->update('tab_termo', $dadosPOST, array('str_pk_termo', $str_pk_termo));

        $this->dados['tabela'][0]['colunas']['pre'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Funcionario', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->dados['tabela'][1]['colunas']['pre'] = $this->crud->read('tab_construct', array('str_aplicacao' => 'Equipamento', 'bol_tabela' => 'Y'), 'str_tab_index ASC');
        $this->load->view('index/index', $this->dados);
        return(NULL);
    }

    public function adicionarFuncionario($str_pk_termo, $str_pk_termo_detalhe_funcionario) {
        $termo = $this->crud->read($tabela = "tab_termo", $where = array("str_pk_termo" => $str_pk_termo), $order_by = NULL, $offset = NULL, $limit = NULL);
        $funcionario = $this->crud->read($tabela = "tab_funcionario", $where = array("str_pk_funcionario" => $str_pk_termo_detalhe_funcionario), $order_by = NULL, $offset = NULL, $limit = NULL);
        /**/
        $dt['str_pk_termo_detalhe_funcionario'] = $this->dados['str_chave'];
        $dt['str_pk_termo'] = $termo['result'][0]->str_pk_termo;
        // $dt['bol_ativo'] = $termo['result'][0]->bol_ativo;
        // $dt['str_pk_chave_antiga'] = $termo['result'][0]->str_pk_chave_antiga;
        // $dt['str_tipo_termo'] = $termo['result'][0]->str_tipo_termo;
        $dt['str_responsavel'] = $termo['result'][0]->str_responsavel;
        $dt['dtm_data'] = $termo['result'][0]->dtm_data;
        $dt['dtm_hora'] = $termo['result'][0]->dtm_hora;
        /**/
        $df['str_pk_funcionario'] = $funcionario['result'][0]->str_pk_funcionario;
        $df['bol_ativo'] = $funcionario['result'][0]->bol_ativo;
        $df['str_nome'] = $funcionario['result'][0]->str_nome;
        $df['str_origem'] = $funcionario['result'][0]->str_origem;
        $df['str_lotacao'] = $funcionario['result'][0]->str_lotacao;
        $df['str_funcao'] = $funcionario['result'][0]->str_funcao;
        $df['str_id_matricula'] = $funcionario['result'][0]->str_id_matricula;
        $df['str_cpf'] = $funcionario['result'][0]->str_cpf;
        $df['str_rg'] = $funcionario['result'][0]->str_rg;
        $df['str_emitido'] = $funcionario['result'][0]->str_emitido;
        $df['str_telefone'] = $funcionario['result'][0]->str_telefone;
        $df['str_telefone'] = $funcionario['result'][0]->str_email;
        $df['str_cep'] = $funcionario['result'][0]->str_cep;
        $df['str_endereco'] = $funcionario['result'][0]->str_endereco;
        $df['int_numero'] = $funcionario['result'][0]->int_numero;
        $df['str_complemento'] = $funcionario['result'][0]->str_complemento;
        $df['str_bairro'] = $funcionario['result'][0]->str_bairro;
        $df['str_municipio'] = $funcionario['result'][0]->str_municipio;
        $df['str_uf'] = $funcionario['result'][0]->str_uf;
        // $df['str_responsavel'] = $funcionario['result'][0]->str_responsavel;
        // $df['dtm_data'] = $funcionario['result'][0]->dtm_data;
        // $df['dtm_hora'] = $funcionario['result'][0]->dtm_hora;
        $mesclar = array_merge($dt, $df);
        $dados = array_filter($mesclar);
        $resultado = $this->crud->create('tab_termo_detalhe_funcionario', $dados);
        echo anchor(base_url($this->controller . "/fechar/" . $str_pk_termo), "Fechar");
        $this->dc->ep($dados, TRUE);
        $this->dc->ep($resultado, TRUE);
        redirect($this->controller . '/fechar');
        return(NULL);
    }

    public function adicionarEquipamento($str_pk_termo, $str_pk_termo_detalhe_equipamento) {
        $termo = $this->crud->read($tabela = "tab_termo", $where = array("str_pk_termo" => $str_pk_termo), $order_by = NULL, $offset = NULL, $limit = NULL);
        $equipamento = $this->crud->read($tabela = "tab_equipamento", $where = array("str_pk_equipamento" => $str_pk_termo_detalhe_equipamento), $order_by = NULL, $offset = NULL, $limit = NULL);
        /**/
        $dt['str_pk_termo_detalhe_equipamento'] = $this->dados['str_chave'];
        $dt['str_pk_termo'] = $termo['result'][0]->str_pk_termo;
        // $dt['bol_ativo'] = $termo['result'][0]->bol_ativo;
        // $dt['str_pk_chave_antiga'] = $termo['result'][0]->str_pk_chave_antiga;
        // $dt['str_tipo_termo'] = $termo['result'][0]->str_tipo_termo;
        $dt['str_responsavel'] = $termo['result'][0]->str_responsavel;
        $dt['dtm_data'] = $termo['result'][0]->dtm_data;
        $dt['dtm_hora'] = $termo['result'][0]->dtm_hora;
        /**/
        $de['str_pk_equipamento'] = $equipamento['result'][0]->str_pk_equipamento;
        $de['bol_ativo'] = $equipamento['result'][0]->bol_ativo;
        $de['str_tipo_objeto'] = $equipamento['result'][0]->str_tipo_objeto;
        $de['int_n_contrato'] = $equipamento['result'][0]->int_n_contrato;
        $de['str_n_processo'] = $equipamento['result'][0]->str_n_processo;
        $de['str_patrimonio'] = $equipamento['result'][0]->str_patrimonio;
        $de['str_n_serie'] = $equipamento['result'][0]->str_n_serie;
        $de['str_marca'] = $equipamento['result'][0]->str_marca;
        $de['str_modelo'] = $equipamento['result'][0]->str_modelo;
        $de['str_n_linha_tel'] = $equipamento['result'][0]->str_n_linha_tel;
        $de['str_imei'] = $equipamento['result'][0]->str_imei;
        $de['str_sim_card'] = $equipamento['result'][0]->str_sim_card;
        $de['str_ns_carregador'] = $equipamento['result'][0]->str_ns_carregador;
        $de['str_ns_bateria'] = $equipamento['result'][0]->str_ns_bateria;
        $de['str_ns_teclado'] = $equipamento['result'][0]->str_ns_teclado;
        $de['str_ns_mouse'] = $equipamento['result'][0]->str_ns_mouse;
        $de['str_observacoes'] = $equipamento['result'][0]->str_observacoes;
        $de['str_responsavel'] = $equipamento['result'][0]->str_responsavel;
        $de['dtm_data'] = $equipamento['result'][0]->dtm_data;
        $de['dtm_hora'] = $equipamento['result'][0]->dtm_hora;
        $mesclar = array_merge($dt, $de);
        $dados = array_filter($mesclar);
        $resultado = $this->crud->create('tab_termo_detalhe_equipamento', $dados);
        ($termo['result'][0]->str_tipo_termo == '(TR) TERMO DE RESPONSABILIDADE') ? ($du['bol_ativo'] = 'N') : ($du['bol_ativo'] = 'Y');
        $dados = array_filter($du);
        $this->crud->update('tab_equipamento', $dados, array('str_pk_equipamento', $equipamento['result'][0]->str_pk_equipamento), $limit = 1);
        echo anchor(base_url($this->controller . "/fechar/" . $str_pk_termo), "Fechar");
        $this->dc->ep($dados, TRUE);
        $this->dc->ep($resultado, TRUE);
        redirect($this->controller . '/fechar');
        return(NULL);
    }

}
