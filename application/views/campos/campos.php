
<?php

// $this->dc->ep($set_value, TRUE);
(($this->uri->segment(2) == 'atualizar') && $this->uri->segment(3) == NULL) ? (redirect($this->controller . '/cadastrar')) : (NULL);
if ($str_tipo == 'input') {
    /**/
    if ($set_value) {
        $value = (isset($set_value->$str_name)) ? ($set_value->$str_name) : (NULL);
        (isset($str_name) && ($str_name == 'str_pk_termo')) ? ($value = $this->uri->segment(3)) : (NULL);
        (isset($str_name) && ($str_name == 'str_pk_termo_detalhe_funcionario')) ? ($value = $str_chave) : (NULL);
    } else {
        $value = NULL;
        (isset($str_name) && ($str_name == 'str_pk_funcionario')) ? ($value = $str_chave) : (NULL); 
        (isset($str_name) && ($str_name == 'str_pk_chave_operacao')) ? ($value = $str_chave) : (NULL);
        (isset($str_name) && ($str_name == 'str_pk_termo')) ? ($value = $str_chave) : (NULL);
        (isset($str_name) && ($str_name == 'str_pk_equipamento')) ? ($value = $str_chave) : (NULL);
        (isset($str_name) && ($str_name == 'str_pk_termo_detalhe_funcionario')) ? ($value = $str_chave) : (NULL);
    }
    ($str_name == 'str_responsavel') ? ($value = $this->session->userdata('str_nome')) : (NULL);
    ($str_name == 'dtm_data') ? ($value = date('Y-m-d')) : (NULL);
    ($str_name == 'dtm_hora') ? ($value = date('H:m:s')) : (NULL);
    $data = array(
        'name' => $str_name,
        'id' => $str_id,
        'value' => $str_value,
        'maxlength' => $int_maxlength,
        'size' => $int_size,
        'placeholder' => $str_placeholder,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
        'str_autofocus' => $str_autofocus,
        'required' => $str_required,
        'style' => $str_style,
    );
    $asterisco = ($str_required !== "") ? (" <a id='r'>*</a>: ") : (": ");
    echo form_label("{$str_titulo} ({$char_accesskey})" . $asterisco, "{$str_name}");
    echo "\n";
    echo form_input(array_filter($data), set_value("{$str_name}", $value)); // Filtra os elementos nulos ou em branco
    echo "\n";
    /* */
}
if ($str_tipo == 'dropdown') {
    //$this->dc->ep($my_dados_DB['select'][$str_name]['result']);
    if ($str_name == 'str_tipo_objeto') {
        // $this->dc->ep($set_value->str_tipo_objeto, TRUE);
        $atualizacao = (isset($set_value->str_tipo_objeto)) ? (array($set_value->str_tipo_objeto => $set_value->str_tipo_objeto)) : (array('AGUARDANDO CADASTRO' => 'AGUARDANDO CADASTRO'));
        foreach ($my_dados_DB['select'][$str_name]['result'] as $valor) {
            $dropdown[$valor->str_tipo_objeto] = substr($valor->str_tipo_objeto, 0, 60);
        }
    } elseif ($str_name == 'str_tipo_termo') {
        //$this->dc->ep($set_value->str_tipo_termo, TRUE);
        $atualizacao = (isset($set_value->str_tipo_termo)) ? (array($set_value->str_tipo_termo => $set_value->str_tipo_termo)) : (array('AGUARDANDO CADASTRO' => 'AGUARDANDO CADASTRO'));
        foreach ($my_dados_DB['select'][$str_name]['result'] as $valor) {
            $dropdown[$valor->str_tipo_termo] = substr($valor->str_tipo_termo, 0, 60);
        }
    } elseif ($str_name == 'str_marca') {
        // $this->dc->ep($set_value->str_marca, TRUE);
        $atualizacao = (isset($set_value->str_marca)) ? (array($set_value->str_marca => $set_value->str_marca)) : (array('AGUARDANDO CADASTRO' => 'AGUARDANDO CADASTRO'));
        foreach ($my_dados_DB['select'][$str_name]['result'] as $valor) {
            $dropdown[$valor->str_marca] = substr($valor->str_marca, 0, 60);
        }
    } elseif ($str_name == 'str_modelo') {
        // $this->dc->ep($set_value->str_modelo, TRUE);
        $atualizacao = (isset($set_value->str_modelo)) ? (array($set_value->str_modelo => $set_value->str_modelo)) : (array('AGUARDANDO CADASTRO' => 'AGUARDANDO CADASTRO'));
        foreach ($my_dados_DB['select'][$str_name]['result'] as $valor) {
            $dropdown[$valor->str_modelo] = substr($valor->str_modelo, 0, 60);
        }
    } elseif ($str_name == 'str_pk_funcionario') {
        // $this->dc->ep($set_value->str_modelo, TRUE);
        $atualizacao = (isset($set_value->str_pk_funcionario)) ? (array($set_value->str_pk_funcionario => $set_value->str_pk_funcionario)) : (array('AGUARDANDO CADASTRO' => 'AGUARDANDO CADASTRO'));
        foreach ($my_dados_DB['select'][$str_name]['result'] as $valor) {
            $dropdown[$valor->str_pk_funcionario] = $valor->str_nome . " " . $valor->str_pk_funcionario . " " . $valor->str_lotacao . " " . $valor->str_id_matricula;
        }
    }
    $options = array_merge($atualizacao, $dropdown);
    $shirts_on_sale = array('small', 'large');
    $asterisco = ($str_required !== "") ? (" <a id='r'>*</a>: ") : (": ");
    echo form_label("{$str_titulo} ({$char_accesskey})" . $asterisco, "{$str_name}");
    echo form_dropdown($str_name, $options, $str_name);
}

//$this->dc->ep($set_value);
if ($str_tipo == 'hidden') {
    $value = ($set_value) ? ($set_value->$str_name) : (NULL);
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    (($str_name == 'str_pk_usuario') && ($value == NULL)) ? ($value = $str_chave) : (NULL);
    (($str_name == 'str_pk_equipamento') && ($value == NULL)) ? ($value = $str_chave) : (NULL);
    (($str_name == 'str_pk_funcionario') && ($value == NULL)) ? ($value = $str_chave) : (NULL);
    (($str_name == 'str_pk_termo') && ($value == NULL)) ? ($value = $str_chave) : (NULL);
    (($str_name == 'str_responsavel') && ($value == NULL)) ? ($value = 'Anonimo') : (NULL);
    (($str_name == 'dtm_data') && ($value == NULL)) ? ($value = $data) : (NULL);
    (($str_name == 'dtm_hora') && ($value == NULL)) ? ($value = $hora) : (NULL);
    $data = array(
        $str_name => $value
    );
    array_filter($data);
    echo form_hidden($data);
    echo "\n";
}

if ($str_tipo == 'password') {
    $input = NULL;
    $value = NULL;
    $data = array(
        'name' => $str_name,
        'id' => $str_id,
        'value' => $str_value,
        'maxlength' => $int_maxlength,
        'size' => $int_size,
        'placeholder' => $str_placeholder,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
        'str_autofocus' => $str_autofocus,
        'required' => $str_required,
        'style' => $str_style,
    );
    $asterisco = ($str_required !== "") ? (" <a id='r'>*</a>: ") : (": ");
    echo form_label("{$str_titulo} ({$char_accesskey})" . $asterisco, "{$str_name}");
    echo "\n";
    echo form_password(array_filter($data), set_value("{$input}", $value)); // Filtra os elementos nulos ou em branco
    echo "\n";
}

if ($str_tipo == 'date') {
    if ($set_value) {
        $value = $set_value->$str_name;
    } else {
        $value = NULL;
    }
    $data = array(
        'name' => $str_name,
        'id' => $str_id,
        'value' => $str_value,
        'tabindex' => "{$str_tab_index}",
        'accesskey' => "{$char_accesskey}",
    );
    $asterisco = ($str_required !== "") ? (" <a id='r'>*</a>: ") : (": ");
    echo form_label("{$str_titulo} ({$char_accesskey})" . $asterisco, "{$str_name}");
    echo "\n";
    echo my_form_date(array_filter($data)); // Filtra os elementos nulos ou em branco
    echo "\n";
    print_r($value);
}

if ($str_tipo == 'checkbox') {
    echo $str_name;
    $value = ($set_value) ? ($set_value->$str_name) : (NULL);
    $data = array(
        'name' => $str_name,
        'id' => $str_id,
        'value' => $str_value,
        'checked' => ($value == 'Y') ? (TRUE) : (FALSE),
        'style' => $str_style
    );
    echo "<div>";
    echo form_checkbox($data) . "{$str_titulo} ";
    echo "</div>";
    echo "\n";
}

if ($str_tipo == 'form_radio') {
    echo "<div style='border:1px solid #FFFFFF;'>";
    $value = ($set_value) ? ($set_value->$str_name) : (NULL);
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
        echo form_radio($dados, "accesskey = {$char_accesskey} tabindex = {$str_tab_index}" . "\n");
        echo (($i % 2 == 0) ? "Sim" : "Não");
        echo "</div>";
    }
    echo "<div style='float: none;'>&NegativeMediumSpace;</div>";
    echo "<div style='font-size: 0px'>&NegativeMediumSpace;</div>";
    echo "</div>";
}

if ($str_tipo == 'submit') {
    $dados = array(
        'name' => 'submit',
        'tabindex' => "{$str_tab_index}"
    );
    echo form_submit($dados, $str_titulo);
    echo "\n";
}
?>
<?php

//$this->dc->ep($str_name);
/**
  $haystack = 'ababcd';
  $needle = 'aB';

  $pos = strripos($haystack, $needle);

  if ($pos === false) {
  echo "Sinto muito, nós não encontramos ($needle) em ($haystack)";
  } else {
  echo "Parabéns!\n";
  echo "Nós encontramos a última ($needle) em ($haystack) na posição ($pos)";
  }
  /* */
?>
