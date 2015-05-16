<?php

(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Model_termo extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->str_sistema = ($this->input->cookie('sistema', false)) ? $this->input->cookie('sistema', false) : NULL;
    }

    public function insertFuncionario($str_pk_funcionario) {
        $query = $this->db->query(""
                . ""
                . "INSERT INTO tab_termo_detalhe_funcionario ("
                . "`str_pk_funcionario`,"
                . "`bol_ativo`,"
                . "`str_nome`,"
                . "`str_origem`,"
                . "`str_lotacao`,"
                . "`str_funcao`,"
                . "`str_id_matricula`,"
                . "`str_cpf`,"
                . "`str_rg`,"
                . "`str_emitido`,"
                . "`str_telefone`,"
                . "`str_cep`,"
                . "`str_endereco`,"
                . "`int_numero`,"
                . "`str_complemento`,"
                . "`str_bairro`,"
                . "`str_municipio`,"
                . "`str_uf`,"
                . "`str_responsavel`,"
                . "`dtm_data`,"
                . "`dtm_hora`"
                . ") "
                . "SELECT "
                . "`str_pk_funcionario`,"
                . "`bol_ativo`,"
                . "`str_nome`,"
                . "`str_origem`,"
                . "`str_lotacao`,"
                . "`str_funcao`,"
                . "`str_id_matricula`,"
                . "`str_cpf`,"
                . "`str_rg`,"
                . "`str_emitido`,"
                . "`str_telefone`,"
                . "`str_cep`,"
                . "`str_endereco`,"
                . "`int_numero`,"
                . "`str_complemento`,"
                . "`str_bairro`,"
                . "`str_municipio`,"
                . "`str_uf`,"
                . "`str_responsavel`,"
                . "`dtm_data`,"
                . "`dtm_hora` "
                . "FROM tab_funcionario "
                . "WHERE str_pk_funcionario = '" . $str_pk_funcionario . "';"
                . "");
        $insertFuncionario = array(
            'qtd' => count($query),
            'result' => $query
        );
        return($insertFuncionario);
    }

}
