<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_hidden.php
/**
  $this->dc->ep($this->uri->segment(1), TRUE);
  $this->dc->ep($this->uri->segment(2), TRUE);
  $this->dc->ep($this->uri->segment(3), TRUE);
  $this->dc->ep($this->uri->segment(4));
  /* */
if ($this->uri->segment(2) == 'atualizar' && $this->uri->segment(3) !== NULL && isset($set_value)) {
    $valor = (array) $set_value;
    $value = NULL;
    ($str_name == 'submit' || $str_name == 'str_telefone_list') ? (NULL) : ($value = $valor[$str_name]); // Evita erro no campo submit
} else {
    $value = NULL;
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_pk_funcionario_telefone') ? ($value = $str_chave) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_sistema') ? ($value = $this->input->cookie('sistema', false)) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_responsavel') ? ($value = $this->session->userdata('str_responsavel')) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_pk_equipamento') ? ($value = $str_chave) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_pk_funcionario') ? ($value = $str_chave) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'str_pk_chave_operacao') ? ($value = $str_chave) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'dtm_data') ? ($value = date('Y-m-d')) : (NULL);
    ($this->uri->segment(2) !== 'atualizar' && $str_name == 'dtm_hora') ? ($value = date('H:m:s')) : (NULL);
}
if (($this->uri->segment(2) == 'cadastrar' && $this->uri->segment(3) !== NULL)) {
    ($this->uri->segment(1) == 'Telefone' && $this->uri->segment(2) == 'cadastrar' && $this->uri->segment(3) !== NULL && $str_name == 'str_pk_funcionario') ? ($value = $value = $this->uri->segment(3)) : (NULL);
    ($this->uri->segment(1) == 'Telefone' && $this->uri->segment(2) == 'cadastrar' && $this->uri->segment(3) !== NULL && $str_name == 'str_pk_funcionario_telefone') ? ($value = $str_chave) : (NULL);
}
// $this->dc->ep($value);
$asterisco = ($str_required !== "") ? (" <a id='r'>*</a>: ") : (": ");
$accesskey = ($char_accesskey) ? ($char_accesskey) : ("X");
// Array que monta a TAG
$data = array(
    $str_name => $value
);
// str_pk_chave_operacao
if ($str_tipo == 'hidden' && $str_name == 'str_pk_chave_operacao') {
    echo "\n" . "<BR />" . "\n" . "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo $value . "\n" . "<BR />";
}
// dtm_data
if ($str_tipo == 'hidden' && $str_name == 'dtm_data') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// dtm_hora
if ($str_tipo == 'hidden' && $str_name == 'dtm_hora') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// str_pk_equipamento
if ($str_tipo == 'hidden' && $str_name == 'str_pk_equipamento') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// str_responsavel
if ($str_tipo == 'hidden' && $str_name == 'str_responsavel') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// str_sistema
if ($str_tipo == 'hidden' && $str_name == 'str_sistema') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// str_pk_funcionario
if ($str_tipo == 'hidden' && $str_name == 'str_pk_funcionario') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
// str_pk_funcionario_telefone
if ($str_tipo == 'hidden' && $str_name == 'str_pk_funcionario_telefone') {
    echo "<BR />" . $str_titulo . "({$accesskey})" . $asterisco . "\n" . "<BR />";
    echo form_hidden($data) . "\n";
    echo $value . "\n" . "<BR />";
}
?>