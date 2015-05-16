<?php

// echo 'C:\xampp\htdocs\cilab\v1\cilab\application\controllers\Index.php';
(!defined('BASEPATH')) ? exit('No direct script access allowed') : NULL;

class FormConstruct extends CI_Controller {

    private $dados = array();

    public function __construct() {
        define('my_img', 'assets/img/');
        parent::__construct();
        $this->llhc(); // Load Library / Load Helper / Load Models
        $this->dc->setController('FormConstruct'); // Dados Controller (dc)
        $this->dc->setSistema(($this->input->cookie('sistema', false)) ? ($this->input->cookie('sistema', false)) : ('todos'));
        $this->controller = $this->dc->getController();
        $this->sistema = $this->dc->getSistema();
        $this->dados = $this->dc->my_dados_controller();
    }

    public function index() {
        redirect($this->controller . '/insertChave');
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
        return(NULL);
    }

    private function loadModel() {
        //$this->load->model('', ''); //('Model_form', 'form')
        return(NULL);
    }

    public function insertChave() {
        $this->load->model('Model_crud', 'crud');
        echo $this->dados['str_chave'];
        $dados['str_pk_form_construct'] = $this->dados['str_chave'];
        $this->crud->create('tab_construct', $dados);
        return(NULL);
    }

    //$this->dc->ep($this->dados);


    public function validar() {
        echo "Validando...";
        return(NULL);
    }

}
