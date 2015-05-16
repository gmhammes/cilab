<?php

(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Model_equipamento extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->str_sistema = ($this->input->cookie('sistema', false)) ? $this->input->cookie('sistema', false) : NULL;
    }

    public function chaveamento($chave) {
        //SELECT nome_país FROM país where CHARACTER_LENGTH(nome_país)=6 
        $data = array(
            'str_pk_funcionario' => $chave,
        );
        $this->db->where('CHARACTER_LENGTH(str_pk_funcionario) <', 9);
        $this->db->limit(1);
        $this->db->update('tab_funcionario', $data);
    }

}
