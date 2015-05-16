<?php
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
    $my_dados_DB['tabela'][0]['conteudo'],
    $my_dados_DB['tabela'][1]['conteudo'],
    $my_dados_DB['tabela'][2]['conteudo']
);
/* /
  $this->dc->ep($my_dados_DB['tabela'][0]['conteudo']['result'][0]->str_pk_termo, TRUE);
  $this->dc->ep($my_dados_DB['tabela'][0]['conteudo']['result'][0]->str_pk_chave_antiga, TRUE);
  $this->dc->ep($my_dados_DB['tabela'][0]['conteudo']['result'][0]);
  /* */
?>
<div>
    <div class="tituloAplicacao">
        <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
    </div>
    <div>
        <h1>Nº <?= $my_dados_DB['tabela'][0]['conteudo']['result'][0]->str_pk_termo; ?></h1>
    </div>
    <div class="center">
        Nº (Antigo): <?= $my_dados_DB['tabela'][0]['conteudo']['result'][0]->str_pk_chave_antiga; ?>
    </div>
    <div class="right">
        Data: <?= $my_dados_DB['tabela'][0]['conteudo']['result'][0]->dtm_data; ?> // Hora: <?= $my_dados_DB['tabela'][0]['conteudo']['result'][0]->dtm_hora; ?>
    </div>
    <BR />
    <BR />
    <BR />
    <div class="justify">
        <?php foreach ($my_dados_DB['tabela'][1]['conteudo']['result'] as $value): ?>
            <?php
            $value = (array) $value; // Transforma objeto em array
            ?>
            Eu <b><font style='text-decoration: underline;'><?= strtoupper($value['str_nome']); ?></font></b>, 
            cargo: <b><font style='text-decoration: underline;'><?= strtoupper($value['str_funcao']); ?></font></b>, 
            Lotado no(a): <b><font style='text-decoration: underline;'><?= strtoupper($value['str_lotacao']); ?></font></b>, 
            inscrito no CPF sob o nº <b><font style='text-decoration: underline;'><?= strtoupper($value['str_cpf']); ?></font></b>, 
            RG nº<b><font style='text-decoration: underline;'><?= strtoupper($value['str_rg']); ?></font></b>
            e na Matrícula: <b><font style='text-decoration: underline;'><?= strtoupper($value['str_id_matricula']); ?></font></b>, 
            residente e domiciliado à <b><font style='text-decoration: underline;'><?= strtoupper($value['str_endereco']); ?></font></b>,
            <b><font style='text-decoration: underline;'><?= strtoupper($value['int_numero']); ?></font></b>, 
            <b><font style='text-decoration: underline;'><?= strtoupper($value['str_complemento']); ?></font></b>.
            <b><font style='text-decoration: underline;'><?= strtoupper($value['str_bairro']); ?></font></b>. 
            CEP: <b><font style='text-decoration: underline;'><?= strtoupper($value['str_cep']); ?></font></b>.
            <b><font style='text-decoration: underline;'><?= strtoupper($value['str_municipio']); ?></font></b> - 
            <b><font style='text-decoration: underline;'><?= strtoupper($value['str_uf']); ?></font></b>, 
            mediante este documento declara responsabilizar-se pela conservação dos bens abaixo descritos, alugados por esta SECRETARIA DE ESTADO DE GOVERNO, sob a atenção da COORDENADORIA DE TI, inscrito no CNPJ sob o nº 03.161.283/001-41, até o dia 28 de dezembro de 2018, comprometendo-se a devolvê-lo em perfeito estado ao fim deste prazo.
        <?php endforeach; ?>

        Em caso de extravio e danos que acarretem a perda total ou parcial do bem, fica obrigado a ressarcir o proprietário dos prejuízos experimentados."
    </div>
    <BR />
    <div>
        <?php

        function colunas($controller = NULL, $metodo = NULL) {
            if ($controller == 'Termo' && $metodo == 'listar') {
                $coluna[] = '';
                $coluna[] = '';
                $coluna[] = '';
            } elseif ($controller == 'Termo' && $metodo == 'exibir') {
                $coluna[] = '';
            }
            return($coluna);
        }
        ?>
        <?php
        // Titulo das Colunas
        foreach ($my_dados_DB['tabela'][2]['campos']['result'] as $value) {
            $value = (array) $value; // Transforma objeto em array
            $coluna[] = $value['str_titulo'];
        }
        // Acrescenta colunas para o Painel de Controle
        $coluna = array_merge($coluna, colunas($controller, $metodo));
        // Campos para Conteúdo da Tabela
        foreach ($my_dados_DB['tabela'][2]['campos']['result'] as $value) {
            $value = (array) $value;
            $campo[] = $value['str_name'];
        }
        // Importante paa não dar erro caso não seja passado vlor nenhum para a tabela
        $add_row = array(NULL);
        // Exibe Titulos das Colunas
        $this->table->set_heading($coluna);
        // Processo de inclusão de dados
        foreach ($my_dados_DB['tabela'][2]['conteudo']['result'] as $value) {
            $value = (array) $value; // Transforma objeto em array
            for ($i = 0; $i < count($campo); $i++) {
                $add_row[$i] = $value[$campo[$i]];
            }
            if ($controller == 'Termo' && $metodo == 'listar') {
                $add_row[$i++] = anchor_popup(base_url("Termo" . "/exibir/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[T]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[T]" . "</DIV>"), $atts);
                $add_row[$i++] = anchor_popup(base_url("Funcionario" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[F]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[F]" . "</DIV>"), $atts);
                $add_row[$i++] = anchor_popup(base_url("Equipamento" . "/atualizar/" . $value['str_pk_termo'] . "/pop"), ($value['bol_ativo'] == 'Y') ? ("<DIV class = 'verde'>" . "[E]" . "</DIV>") : ("<DIV class = 'vermelho'>" . "[E]" . "</DIV>"), $atts);
            } else {
                $add_row[$i++] = '';
            }
            $this->table->add_row($add_row);
        }
        ?>
        <?= $this->table->generate(); ?>
    </div>
    <BR />
    <div class="justify">
        Quaisquer alterações no equipamento acima especificado, somente poderá ser feita pela Coordenadoria de Informática da SEGOV.

        Declaro estar recebendo o equipamento acima descrit nas condições analisadas, responsabilizando-me por qualquer dano ou extravio que porventura venha a ocorrer durante o período em que estiver sob minha guarda e responsabilidade. Nos casos de cessação de minhas atividades, afastamentos, exoneração ou aposentadoria.

        Deverá ser instaurada Sindicância, nos termos do Decreto nº 7526, de 06 de setembro de 1984, que aprovou  Manual do Sindicante, em todos os casos em que ocorrer furto, roubo, destruição ou outra qualquer circunstância que acarrete perda ou extravio do equipamento objeto desta Resolução, devendo dela constar o devido registro de ocorrência.

        IMPORTANTE: No caso de possuir serviço de troca de dados com a rede mundial de computadores (pelos modens), o mesmo é contratado com um limite estabelecido de 10GB para download sendo cobrado do usuário o excedente da franquia. 
    </div>
</div>