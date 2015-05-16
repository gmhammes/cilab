<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\funcionario\listar.php
$atts = array(
    'width' => '1000',
    'height' => '580',
    'scrollbars' => 'no',
    'status' => 'yes',
    'resizable' => 'yes',
    'screenx' => '0',
    'screeny' => '0'
);
$repositorio = array(
);

function legendaTitulo($cont = NULL, $met = NULL) {
    if ($cont == 'Funcionario' && $met == 'listar') {
        $tabela['titulo'] = array(
            /* 01 */ 'Letra',
            /* 02 */ 'Função da Aplicação'
        );
    }
    if ($cont == 'Equipamento' && $met == 'listar') {
        $tabela['titulo'] = array(
            /* 01 */ 'Letra',
            /* 02 */ 'Função da Aplicação'
        );
    }
    if ($cont == 'Termo' && $met == 'listar') {
        $tabela['titulo'] = array(
            /* 01 */ 'Letra',
            /* 02 */ 'Função da Aplicação'
        );
    }
    if ($cont == NULL && $met == NULL) {
        $tabela['titulo'] = array(
            /* 01 */ 'Letra',
            /* 02 */ 'Função da Aplicação'
        );
    }
    return($tabela);
}

function legendaConteudo($cont = NULL, $met = NULL) {
    if ($cont == 'Funcionario' && $met == 'listar') {
        $my_dados_DB['legenda'] = array(
            array('str_letra' => '[D]',
                'str_aplicacao' => 'Dasativa o funcionário'
            ),
            array('str_letra' => '[E]',
                'str_aplicacao' => 'Editar'
            )
        );
    }
    if ($cont == 'Equipamento' && $met == 'listar') {
        $my_dados_DB['legenda'] = array(
            array('str_letra' => '[D]',
                'str_aplicacao' => 'Dasativa o equipamento'
            ),
            array('str_letra' => '[E]',
                'str_aplicacao' => 'Editar o equipamento'
            )
        );
    }
    if ($cont == 'Termo' && $met == 'listar') {
        $my_dados_DB['legenda'] = array(
            array('str_letra' => '[D]',
                'str_aplicacao' => 'Desativar Termo'
            ),
        );
    }
    if ($cont == NULL && $met == NULL) {
        $my_dados_DB['legenda'] = array(
            array('str_letra' => NULL,
                'str_aplicacao' => NULL
            ),
        );
    }
    return($my_dados_DB);
}

function colunas($controller = NULL, $metodo = NULL) {
    if ($controller == 'Funcionario' && $metodo == 'listar') {
        $coluna[] = '';
        $coluna[] = '';
    }
    if ($controller == 'Equipamento' && $metodo == 'listar') {
        $coluna[] = '';
        $coluna[] = '';
    }
    if ($controller == 'Termo' && $metodo == 'listar') {
        $coluna[] = '';
    }
    return($coluna);
}
?>
<div>
    <div class="tituloAplicacao">
        <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
    </div>
    <div class="center">
        <?php
        $config['base_url'] = 'http://localhost/cilab/v2/cilab/' . $controller . '/' . $metodo;
        $config['total_rows'] = $my_dados_DB['tabela'][0]['conteudo']['qtd'];
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        echo $this->pagination->create_links();
        ?>
    </div>
    <?php
    // Titulo das Colunas
    foreach ($my_dados_DB['tabela'][0]['campos']['result'] as $value) {
        $value = (array) $value; // Transforma objeto em array
        $coluna[] = $value['str_titulo'];
    }
    echo (isset($coluna)) ? (NULL) : (exit('$my_dados_DB[tabela][0][campos][result]'));
    // Acrescenta colunas para o Painel de Controle
    $coluna = array_merge($coluna, colunas($controller, $metodo));
    // Campos para Conteúdo da Tabela
    foreach ($my_dados_DB['tabela'][0]['campos']['result'] as $value) {
        $value = (array) $value;
        $campo[] = $value['str_name'];
    }
    // Importante paa não dar erro caso não seja passado vlor nenhum para a tabela
    $add_row = array(NULL);
    // Exibe Titulos das Colunas
    $this->table->set_heading($coluna);
    // Processo de inclusão de dados
    foreach ($my_dados_DB['tabela'][0]['conteudo']['result'] as $value) {
        $value = (array) $value; // Transforma objeto em array
        for ($i = 0; $i < count($campo); $i++) {
            $add_row[$i] = $value[$campo[$i]];
        }
        if ($controller == 'Termo' && $metodo == 'listar') {
            $add_row[$i++] = anchor_popup(base_url("Termo" . "/exibir/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[T]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[T]" . "</DIV>"), $atts);
            $add_row[$i++] = anchor_popup(base_url("Funcionario" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[F]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[F]" . "</DIV>"), $atts);
            $add_row[$i++] = anchor_popup(base_url("Equipamento" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[E]" . "</DIV>"), $atts);
        }
        if ($controller == 'Equipamento' && $metodo == 'listar') {
            $add_row[$i++] = ($value['bol_ativo'] == 'Y') ? (anchor_popup(base_url($controller . "/desativar/" . $value['bol_ativo']), "<DIV class = 'verde'>" . "[D]" . "</DIV>", $atts)) : ("<DIV class = 'laranja'>" . "[D]" . "</DIV>");
            $add_row[$i++] = anchor_popup(base_url("Equipamento" . "/atualizar/" . $value['str_pk_equipamento'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'laranja'>" . "[E]" . "</DIV>"), $atts);
        }
        if ($controller == 'Funcionario' && $metodo == 'listar') {
            $add_row[$i++] = ($value['bol_ativo'] == 'Y') ? (anchor_popup(base_url($controller . "/desativar/" . $value['bol_ativo']), "<DIV class = 'verde'>" . "[D]" . "</DIV>", $atts)) : ("<DIV class = 'laranja'>" . "[D]" . "</DIV>");
            $add_row[$i++] = anchor_popup(base_url("Funcionario" . "/atualizar/" . $value['str_pk_funcionario'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'laranja'>" . "[E]" . "</DIV>"), $atts);
        }
        $this->table->add_row($add_row);
    }
    ?>
    <?= $this->table->generate(); ?>
    <div class="center">
        <?php echo "Total de registros: " . $my_dados_DB['tabela'][0]['conteudo']['qtd'] . "<BR />"; ?>
    </div>
    <div>
        <BR />
        <?php
        // Titulo das colunas
        $titulo = legendaTitulo($controller, $metodo);
        $this->table->set_heading($titulo['titulo']);
        $add_row = array(NULL);
        // Prepara os dados do conteudo
        $array = legendaConteudo($controller, $metodo);
        foreach ($array['legenda'] as $value) {
            $str_letra = "<div class='legendaLetra'>" . $value['str_letra'] . "</div>";
            $str_aplicacao = "<div class='legendaAplicacao'>" . $value['str_aplicacao'] . "</div>";
            // Adiciona os dados do conteudo
            $add_row = array(
                /* 01 */$str_letra,
                /* 02 */ $str_aplicacao,
            );
            $this->table->add_row($add_row);
        }
        echo $this->table->generate();
        ?>
    </div>
</div>
<?php
// Segunda Tabela
$campo = NULL;
$coluna = NULL;
?>
<div>
    <div class="tituloAplicacao">
        <?= $dadosEstilo[1]['titulo_aplicacao']; ?>
    </div>
    <div class="center">
        <?php
        $config['base_url'] = 'http://localhost/cilab/v2/cilab/' . $controller . '/' . $metodo;
        $config['total_rows'] = $my_dados_DB['tabela'][1]['conteudo']['qtd'];
        $config['per_page'] = $limit;
        $this->pagination->initialize($config);
        echo $this->pagination->create_links();
        ?>
    </div>
    <?php
    // Titulo das Colunas
    foreach ($my_dados_DB['tabela'][1]['campos']['result'] as $value) {
        $value = (array) $value; // Transforma objeto em array
        $coluna[] = $value['str_titulo'];
    }
    echo (isset($coluna)) ? (NULL) : (exit('$my_dados_DB[tabela][0][campos][result]'));
    // Acrescenta colunas para o Painel de Controle
    $coluna = array_merge($coluna, colunas($controller, $metodo));
    // Campos para Conteúdo da Tabela
    foreach ($my_dados_DB['tabela'][1]['campos']['result'] as $value) {
        $value = (array) $value;
        $campo[] = $value['str_name'];
    }
    // Importante paa não dar erro caso não seja passado vlor nenhum para a tabela
    $add_row = array(NULL);
    // Exibe Titulos das Colunas
    $this->table->set_heading($coluna);
    // Processo de inclusão de dados
    foreach ($my_dados_DB['tabela'][1]['conteudo']['result'] as $value) {
        $value = (array) $value; // Transforma objeto em array
        for ($i = 0; $i < count($campo); $i++) {
            $add_row[$i] = $value[$campo[$i]];
        }
        if ($controller == 'Termo' && $metodo == 'listar') {
            $add_row[$i++] = anchor_popup(base_url("Termo" . "/exibir/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[T]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[T]" . "</DIV>"), $atts);
            $add_row[$i++] = anchor_popup(base_url("Funcionario" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[F]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[F]" . "</DIV>"), $atts);
            $add_row[$i++] = anchor_popup(base_url("Equipamento" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[E]" . "</DIV>"), $atts);
        }
        if ($controller == 'Equipamento' && $metodo == 'listar') {
            $add_row[$i++] = ($value['bol_ativo'] == 'Y') ? (anchor_popup(base_url($controller . "/desativar/" . $value['bol_ativo']), "<DIV class = 'verde'>" . "[D]" . "</DIV>", $atts)) : ("<DIV class = 'laranja'>" . "[D]" . "</DIV>");
            $add_row[$i++] = anchor_popup(base_url("Equipamento" . "/atualizar/" . $value['str_pk_equipamento'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'laranja'>" . "[E]" . "</DIV>"), $atts);
        }
        if ($controller == 'Funcionario' && $metodo == 'listar') {
            $add_row[$i++] = ($value['bol_ativo'] == 'Y') ? (anchor_popup(base_url($controller . "/desativar/" . $value['bol_ativo']), "<DIV class = 'verde'>" . "[D]" . "</DIV>", $atts)) : ("<DIV class = 'laranja'>" . "[D]" . "</DIV>");
            $add_row[$i++] = anchor_popup(base_url("Funcionario" . "/atualizar/" . $value['str_pk_funcionario'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'laranja'>" . "[E]" . "</DIV>"), $atts);
        }
        $this->table->add_row($add_row);
    }
    ?>
    <?= $this->table->generate(); ?>
    <div>
        <BR />
        <?php
        // Titulo das colunas
        $titulo = legendaTitulo($controller, $metodo);
        $this->table->set_heading($titulo['titulo']);
        $add_row = array(NULL);
        // Prepara os dados do conteudo
        $array = legendaConteudo($controller, $metodo);
        foreach ($array['legenda'] as $value) {
            $str_letra = "<div class='legendaLetra'>" . $value['str_letra'] . "</div>";
            $str_aplicacao = "<div class='legendaAplicacao'>" . $value['str_aplicacao'] . "</div>";
            // Adiciona os dados do conteudo
            $add_row = array(
                /* 01 */$str_letra,
                /* 02 */ $str_aplicacao,
            );
            $this->table->add_row($add_row);
        }
        echo $this->table->generate();
        ?>
    </div>
    <div class="center">
        <?php echo "Total de registros: " . $my_dados_DB['tabela'][1]['conteudo']['qtd'] . "<BR />"; ?>
    </div>
</div>