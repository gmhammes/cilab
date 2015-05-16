<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\equipamento\cadastrar.php
?>
<div class="tituloAplicacao">
    <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
</div>
<?php
if (isset($my_dados_DB['select']) && $my_dados_DB['select'] !== array(NULL)) {
    $dados['select'] = $my_dados_DB['select'];
    // $this->dc->ep($my_dados_DB['select'], TRUE);
    // $this->dc->ep($dados['select']['str_tipo_objeto']['result']);
} else {
    NULL;
}
$dados['set_value'] = (isset($my_dados_DB[0]['atualizar'])) ? ($my_dados_DB[0]['atualizar']['result'][0]) : (array(NULL));
// $this->dc->ep('FIM');
?>
<div>
    <?php
    $attributes = array('onKeyDown' => "if (event.keyCode == '13'){ return false }");
    echo form_open($dadosFormOpen[0]['form'], $attributes);
    // $this->dc->ep('FIM');
    ?>
    <?php echo "\n"; ?>
    <?php //$this->dc->ep($my_dados_DB['agrupamentoFields']['result']);?>
    <?php foreach ($my_dados_DB[0]['agrupamentoFields']['result'] as $value_agrupamento): ?>
        <div>
            <fieldset class="tamanho_46p_250px_block_center">
                <legend><b><?= $value_agrupamento->str_agrupamento; ?></b></legend>
                <div class="rolagem_220px">
                    <?php
                    foreach ($my_dados_DB[0]['form']['result'] as $value_form) {
                        /* C:\xampp\htdocs\cilab\v1\cilab\application\views\equipamento\cadastrar.php */
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
                            /**/
                            $this->load->view('campos/campo_input', $dados);
                            $this->load->view('campos/campo_radio', $dados);
                            $this->load->view('campos/campo_dropdown', $dados);
                            $this->load->view('campos/campo_hidden', $dados);
                            $this->load->view('campos/campo_password', $dados);
                            $this->load->view('campos/campo_submit', $dados);
                            /* */
                        }
                        // $this->dc->ep($dados, TRUE);
                        /* */
                    }
                    ?>
                </div>
            </fieldset>
        </div>
    <?php endforeach; ?>
    <?= form_close(); ?>
    <?php echo "\n"; ?>
</div>