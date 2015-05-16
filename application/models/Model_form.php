<?php

// C:\xampp\htdocs\cif\v3\cif\application\models\Model_funcionario.php
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class Model_form extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->str_sistema = ($this->input->cookie('sistema', false)) ? $this->input->cookie('sistema', false) : NULL;
    }
    

}
