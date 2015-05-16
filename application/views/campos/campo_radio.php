<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_radio.php
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
// str_login
if ($str_tipo == 'radio' && $str_name == 'bol_ativo') {
    echo "<div style='border:1px solid #FFFFFF;'>";
    echo form_label("{$str_titulo}: ", "{$str_name}");
    for ($i = 0; $i <= 1; $i++) {
        echo "<div style='float:left;'>";
        $dados = array(
            'name' => "{$str_name}",
            'id' => "{$str_id}",
            'value' => $atual = (($i % 2 == 0) ? "Y" : "N"),
            'tabindex' => "{str_tab_index}",
            //'checked' => ($value == 'Y') ? (TRUE) : (FALSE),
            'checked' => (isset($value) && ($value == $atual)) ? TRUE : FALSE,
        );
        echo form_radio($dados);
        echo (($i % 2 == 0) ? "Sim" : "Não");
        echo "</div>";
    }
    echo "<div style='float: none;'>&NegativeMediumSpace;</div>";
    echo "<div style='font-size: 0px'>&NegativeMediumSpace;</div>";
    echo "</div>";
}
?>
