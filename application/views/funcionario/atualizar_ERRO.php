<?php
$indVaores = 0;
$indExtras = 0;
$indTitulo = 0;
$indAtualizar = 0;
$indField = 0;
$indForm = 0;
?>
<div class="tituloAplicacao">
    <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
</div>
<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\funcionario\atualizar.php
// $this->dc->ep($my_dados_DB[$indAtualizacao]['atualizacao']['result'][0]);
$dados['set_value'] = (isset($my_dados_DB[$indTitulo]['atualizar'])) ? ($my_dados_DB[$indTitulo]['atualizar']['result'][0]) : (NULL);
?>
<div>
    <?php
    $attributes = array('onKeyDown' => "if (event.keyCode == '13'){ return false }");
    echo form_open($dadosFormOpen[$indForm]['form'], $attributes);
    ?>
    <?php echo "\n"; ?>
    <?php //$this->dc->ep($my_dados_DB['agrupamentoFields']['result']);?>
    <?php foreach ($my_dados_DB[$indField]['agrupamentoFields']['result'] as $value_agrupamento): ?>
        <div>
            <fieldset class="tamanho_46p_250px">
                <legend><b><?= $value_agrupamento->str_agrupamento; ?></b></legend>
                <div class="rolagem_220px">
                    <?php
                    foreach ($my_dados_DB[$indForm]['form']['result'] as $value_form) {
                        if ($value_form->str_agrupamento == $value_agrupamento->str_agrupamento) {
                            $dados['str_tipo'] = $value_form->str_tipo;
                            $dados['str_titulo'] = $value_form->str_titulo;
                            $dados['str_name'] = $value_form->str_name;
                            $dados['str_id'] = $value_form->str_id;
                            $dados['str_value'] = $value_form->str_value;
                            $dados['int_maxlength'] = $value_form->int_maxlength;
                            $dados['int_size'] = $value_form->int_size;
                            $dados['str_placeholder'] = $value_form->str_placeholder;
                            $dados['str_tab_index'] = $value_form->str_tab_index;
                            $dados['char_accesskey'] = $value_form->char_accesskey;
                            $dados['str_autofocus'] = $value_form->str_autofocus;
                            $dados['str_checked'] = $value_form->str_checked;
                            $dados['str_required'] = $value_form->str_required;
                            $dados['str_style'] = $value_form->str_style;
                            $this->load->view('campos/campos', $dados);
                        }
                    }
                    ?>
                </div>
            </fieldset>
        </div>
    <?php endforeach; ?>
    <?= form_close(); ?>
    <?php echo "\n"; ?>
</div>