<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_password.php
/**
  $this->dc->ep($this->uri->segment(1), TRUE);
  $this->dc->ep($this->uri->segment(2), TRUE);
  $this->dc->ep($this->uri->segment(3), TRUE);
  $this->dc->ep($this->uri->segment(4));
  /* */
?>
<?php

if ($this->uri->segment(2) == 'atualizar' && $this->uri->segment(3) !== NULL) {
    $valor = (array) $set_value;
    $value = NULL;
    ($str_name == 'submit' || $str_name == 'str_telefone_list') ? (NULL) : ($value = $valor[$str_name]); // Evita erro no campo submit
} else {
    $valor = NULL;
}
$asterisco = ($str_required == "required") ? (" <a id='r'>*</a>: ") : (": ");
$accesskey = ($char_accesskey) ? ($char_accesskey) : ("X");
if ($str_tipo == 'password' && $str_name == 'str_senha') {
    $data = array(
        'name' => $str_name,
        'id' => $str_name,
        'value' => $valor,
        'maxlength' => $int_maxlength,
        'size' => $int_size,
        'style' => $str_style,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}"
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_password($data) . "\n";
}

if ($str_tipo == 'password' && $str_name == 'password_change') {
    $data = array(
        'name' => $str_name,
        'id' => $str_name,
        'value' => $valor,
        'maxlength' => $int_maxlength,
        'size' => $int_size,
        'style' => $str_style,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}"
    );
    echo form_label("{$str_titulo} ({$accesskey})" . $asterisco, "{$str_name}") . "\n";
    echo form_password($data) . "\n";
}
?>