<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_dropdown.php
/**
$this->dc->ep("Seguimento 1 - " . $this->uri->segment(1), TRUE);
$this->dc->ep("Seguimento 2 - " . $this->uri->segment(2), TRUE);
$this->dc->ep("Seguimento 3 - " . $this->uri->segment(3), TRUE);
$this->dc->ep("Seguimento 4 - " . $this->uri->segment(4), TRUE);
$this->dc->ep("Seguimento 5 - " . $this->uri->segment(5));
/* */
$atts = array(
    'width' => '740',
    'height' => '600',
    'scrollbars' => 'yes',
    'status' => 'yes',
    'resizable' => 'yes',
    'screenx' => '0',
    'screeny' => '0'
);
?>
<?php

if ($this->uri->segment(2) == 'atualizar' && $this->uri->segment(3) !== NULL) {
    $valor = (array) $set_value;
    $value = NULL;
    ($str_name == 'submit' || $str_name == 'str_telefone_list') ? (NULL) : ($value = $valor[$str_name]); // Evita erro no campo submit
} else {
    $value = NULL;
    ($this->uri->segment(3) !== 'cadastrar' && $str_name == 'str_telefone_list') ? ($value = $str_chave) : (NULL);
    ($this->uri->segment(3) !== 'cadastrar' && $str_name == 'str_tipo_objeto') ? ($value = $str_chave) : (NULL);
}
$asterisco = ($str_required == "required") ? (" <a id='r'>*</a>: ") : (": ");
$accesskey = ($char_accesskey !== '') ? ($char_accesskey) : ("X");
$options[NULL] = NULL;
// str_sistema
if ($str_tipo == 'dropdown' && $str_name == 'str_sistema') {
    $select = (array) $select[$str_name]['result'];
    foreach ($select as $value_drop) {
        $value_drop = (array) $value_drop;
        $options[$value_drop[$str_name]] = $value_drop[$str_name];
    }
    $data = array(
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_dropdown($str_name, $options, $value, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
}
// str_tipo_objeto
if ($str_tipo == 'dropdown' && $str_name == 'str_tipo_objeto') {
    // $this->dc->ep($select);
    $select = (array) $select[$str_name]['result'];
    foreach ($select as $value_drop) {
        $value_drop = (array) $value_drop;
        $options[$value_drop[$str_name]] = $value_drop[$str_name];
    }
    $data = array(
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_dropdown($str_name, $options, $value, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
    if ($this->uri->segment(1) == 'Equipamento' && $this->uri->segment(2) == 'cadastrar') {
        echo anchor_popup(base_url("Tipo" . "/cadastrar/" . $value . "/pop"), "[+]", $atts);
    } else {
        echo anchor_popup(base_url("Tipo" . "/cadastrar/" . $this->uri->segment(3) . "/pop"), "[+]", $atts);
    }
}
// str_marca
if ($str_tipo == 'dropdown' && $str_name == 'str_marca') {
    $select = (array) $select[$str_name]['result'];
    foreach ($select as $value_drop) {
        $value_drop = (array) $value_drop;
        $options[$value_drop[$str_name]] = $value_drop[$str_name];
    }
    $data = array(
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_dropdown($str_name, $options, $value, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
}
// str_modelo
if ($str_tipo == 'dropdown' && $str_name == 'str_modelo') {
    $select = (array) $select[$str_name]['result'];
    foreach ($select as $value_drop) {
        $value_drop = (array) $value_drop;
        $options[$value_drop[$str_name]] = $value_drop[$str_name];
    }
    $data = array(
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_dropdown($str_name, $options, $value, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
}
// str_telefone_list
if ($str_tipo == 'dropdown' && $str_name == 'str_telefone_list') {
    $select = (array) $select[$str_name]['result'];
    ($str_name == 'str_telefone_list') ? ($str_name = 'str_telefone') : (NULL);
    foreach ($select as $value_drop) {
        $value_drop = (array) $value_drop;
        $options[$value_drop[$str_name]] = $value_drop[$str_name];
    }
    $data = array(
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_dropdown($str_name, $options, $value, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
    if ($this->uri->segment(2) == 'Funcionário' && $this->uri->segment(3) !== 'cadastrar') {
        echo anchor_popup(base_url("Telefone" . "/cadastrar/" . $value . "/pop"), "[+]", $atts);
    } else {
        echo anchor_popup(base_url("Telefone" . "/cadastrar/" . $this->uri->segment(3) . "/pop"), "[+]", $atts);
    }
}
// $this->dc->ep($options, TRUE);
?>