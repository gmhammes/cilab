<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_input.php
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
}
$asterisco = ($str_required == "required") ? (" <a id='r'>*</a>: ") : (": ");
$accesskey = ($char_accesskey) ? ($char_accesskey) : ("X");
// Array que monta a TAG
$data = array(
    'name' => $str_name,
    'id' => $str_id,
    'value' => $value,
    'maxlength' => $int_maxlength,
    'size' => $int_size,
    'placeholder' => $str_placeholder,
    'tabindex' => "{$str_tab_index}",
    'accesskey' => "{$char_accesskey}",
    'str_autofocus' => $str_autofocus,
    'style' => $str_style,
);
($str_required) ? ($data['required'] = $str_required) : (NULL);
// str_login
if ($str_tipo == 'input' && $str_name == 'str_login') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_patrimonio
if ($str_tipo == 'input' && $str_name == 'str_patrimonio') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_n_serie
if ($str_tipo == 'input' && $str_name == 'str_n_serie') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_ns_carregador
if ($str_tipo == 'input' && $str_name == 'str_ns_carregador') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_ns_bateria
if ($str_tipo == 'input' && $str_name == 'str_ns_bateria') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_ns_teclado
if ($str_tipo == 'input' && $str_name == 'str_ns_teclado') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_ns_mouse
if ($str_tipo == 'input' && $str_name == 'str_ns_mouse') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_imei
if ($str_tipo == 'input' && $str_name == 'str_imei') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_sim_card
if ($str_tipo == 'input' && $str_name == 'str_sim_card') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_n_linha_tel
if ($str_tipo == 'input' && $str_name == 'str_n_linha_tel') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// int_n_contrato
if ($str_tipo == 'input' && $str_name == 'str_n_contrato') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_n_processo
if ($str_tipo == 'input' && $str_name == 'str_n_processo') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_observacoes
if ($str_tipo == 'input' && $str_name == 'str_observacoes') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_nome
if ($str_tipo == 'input' && $str_name == 'str_nome') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_id_matricula
if ($str_tipo == 'input' && $str_name == 'str_id_matricula') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_cpf
if ($str_tipo == 'input' && $str_name == 'str_cpf') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_rg
if ($str_tipo == 'input' && $str_name == 'str_rg') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_emitido
if ($str_tipo == 'input' && $str_name == 'str_emitido') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_origem
if ($str_tipo == 'input' && $str_name == 'str_origem') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_lotacao
if ($str_tipo == 'input' && $str_name == 'str_lotacao') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_funcao
if ($str_tipo == 'input' && $str_name == 'str_funcao') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_telefone
if ($str_tipo == 'input' && $str_name == 'str_telefone') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_cep
if ($str_tipo == 'input' && $str_name == 'str_cep') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_endereco
if ($str_tipo == 'input' && $str_name == 'str_endereco') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// int_numero
if ($str_tipo == 'input' && $str_name == 'int_numero') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_complemento
if ($str_tipo == 'input' && $str_name == 'str_complemento') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_bairro
if ($str_tipo == 'input' && $str_name == 'str_bairro') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_municipio
if ($str_tipo == 'input' && $str_name == 'str_municipio') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_uf
if ($str_tipo == 'input' && $str_name == 'str_uf') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
// str_tipo_objeto
if ($str_tipo == 'input' && $str_name == 'str_tipo_objeto') {
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_input($data) . "\n";
}
?>