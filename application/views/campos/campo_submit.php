<?php

// C:\xampp\htdocs\cilab\v1\cilab\application\views\campos\campo_submit.php
/**
  $this->dc->ep($this->uri->segment(1), TRUE);
  $this->dc->ep($this->uri->segment(2), TRUE);
  $this->dc->ep($this->uri->segment(3), TRUE);
  $this->dc->ep($this->uri->segment(4));
  /* */
?>
<?php

if ($str_tipo == 'submit' && $str_name == 'submit') {
    $dados = array(
        'name' => $str_titulo,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}"
    );
    echo form_submit($dados, $str_titulo) . "\n";
}
?>