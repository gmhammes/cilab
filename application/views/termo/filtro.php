<?php
$url = 'http://localhost/cilab/v2/cilab/Equipamento/listar/';

function chave($titulo = NULL) { // Funçao para informar qual colun do BD está a chve do registro
    ($titulo == 'Funcionário(s)') ? ($varChave = 'str_pk_funcionario') : (NULL);
    ($titulo == 'Equipamento(s)') ? ($varChave = 'str_pk_equipamento') : (NULL);
    ($titulo == NULL) ? ($varChave = '') : (NULL);
    return($varChave);
}
?>
<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\Funcionario\listar.php
$atts = array(
    'width' => '1000',
    'height' => '580',
    'scrollbars' => 'no',
    'status' => 'yes',
    'resizable' => 'yes',
    'screenx' => '0',
    'screeny' => '0'
);
?>
<div>
    <div class="tituloAplicacao">
        <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
    </div>
    <div>
        <?= anchor(base_url($controller . "/cadastrar/" . $this->uri->segment(3)), '<< Novo Filtro'); ?>
    </div>
    <?php
    $indExtras = 0;
    $value_titulo_tabela = NULL;
    $value_row_tabela = NULL;
    $add_row_extras = NULL;
    // O Controle informa quantas tabelas e quais campos vão exibir na tela
    foreach ($tabela[0]['colunas']['pre']['result'] as $value_tabela) {
        $value_titulo_tabela[] = $value_tabela->str_titulo; // Títulos da Tabela
        $value_row_tabela[] = $value_tabela->str_name; // Campos dos BD da Tabela
        $indExtras++;
    }
    //$this->dc->ep($tabela);
    // Além dos títulos "$value_titulo_tabela". Acrescenta-se mais titulos
    $value_titulo_tabela[$indExtras++] = 'Enviar para o Termo';
    $count = count($value_row_tabela); // Importante contatdor para o for "for ($i = 0; $i < $count; $i++)" abaixo
    $add_row = array(NULL); // Importante paa não dar erro caso não seja passado vlor nenhum para a tabela
    ?>
    <!--Vem de "$tabela[$indVaores++]['colunas']['pre']['result']" para informar qtd de tabelas exibidas!-->
    <div>
        <?php
        $this->table->set_heading($value_titulo_tabela); // Titulos das tabelas tratados acima
        foreach ($my_dados_DB[0]['tabela']['result'] as $value_result) { //Recebe os dados do BD passados pelo Controller
            for ($i = 0; $i < $count; $i++) { // Informa as tabelas do DB que foram tratadas acima "$value_row_tabela"
                $add_row_construct[$i] = $value_result->$value_row_tabela[$i]; // "$add_row_construct" monta as linhas para ser chamada
            }
            // Algorítimo para informar o campo que contem a chave para executar Atualização e Excluzão.
            $campo = chave($dadosEstilo[0]['titulo_aplicacao']);
            //$this->dc->ep($campo);
            $chave = $value_result->$campo;
            // Acrescentando mais colunas na tabéla. Acima já foi inclusa as colunas com titulos
            $add_row_extras[$i++] = anchor_popup(base_url($controller . "/adicionarFuncionario/" . $this->uri->segment(3) . "/" . $chave), ($value_result->bol_ativo == 'Y') ? ("<DIV class = 'verde'>" . "Enviar" . "</DIV>") : ("<DIV class = 'vermelho'>" . "Cuidado" . "</DIV>"), $atts);
            // Mescla dois array com as colunas da tabela e as colunas extras
            $add_row = array_merge($add_row_construct, $add_row_extras);
            // Função do Codeigniter que coloca as informações nas linhas da tabela
            $this->table->add_row($add_row);
        }
        echo $this->table->generate();
        ?>
    </div>
</div>

<div>
    <div class="tituloAplicacao">
        <?= $dadosEstilo[1]['titulo_aplicacao']; ?>
    </div>
    <?php
    $indExtras = 0;
    $value_titulo_tabela = NULL;
    $value_row_tabela = NULL;
    $add_row_extras = NULL;
    // O Controle informa quantas tabelas e quais campos vão exibir na tela
    foreach ($tabela[1]['colunas']['pre']['result'] as $value_tabela) {
        $value_titulo_tabela[] = $value_tabela->str_titulo; // Títulos da Tabela
        $value_row_tabela[] = $value_tabela->str_name; // Campos dos BD da Tabela
        $indExtras++;
    }
    //$this->dc->ep($tabela);
    // Além dos títulos "$value_titulo_tabela". Acrescenta-se mais titulos
    $value_titulo_tabela[$indExtras++] = 'Enviar para o Termo';
    $count = count($value_row_tabela); // Importante contatdor para o for "for ($i = 0; $i < $count; $i++)" abaixo
    $add_row = array(NULL); // Importante paa não dar erro caso não seja passado vlor nenhum para a tabela
    ?>
    <!--Vem de "$tabela[$indVaores++]['colunas']['pre']['result']" para informar qtd de tabelas exibidas!-->
    <div>
        <?php
        $this->table->set_heading($value_titulo_tabela); // Titulos das tabelas tratados acima
        foreach ($my_dados_DB[1]['tabela']['result'] as $value_result) { //Recebe os dados do BD passados pelo Controller
            for ($i = 0; $i < $count; $i++) { // Informa as tabelas do DB que foram tratadas acima "$value_row_tabela"
                $add_row_construct[$i] = $value_result->$value_row_tabela[$i]; // "$add_row_construct" monta as linhas para ser chamada
            }
            // Algorítimo para informar o campo que contem a chave para executar Atualização e Excluzão.
            $campo = chave($dadosEstilo[1]['titulo_aplicacao']);
            //$this->dc->ep($campo);
            $chave = $value_result->$campo;
            // Acrescentando mais colunas na tabéla. Acima já foi inclusa as colunas com titulos
            $add_row_extras[$i++] = anchor_popup(base_url($controller . "/adicionarEquipamento/" . $this->uri->segment(3) . "/" . $chave), ($value_result->bol_ativo == 'Y') ? ("<DIV class = 'verde'>" . "Enviar" . "</DIV>") : ("<DIV class = 'vermelho'>" . "Cuidado" . "</DIV>"), $atts);
            // Mescla dois array com as colunas da tabela e as colunas extras
            $add_row = array_merge($add_row_construct, $add_row_extras);
            // Função do Codeigniter que coloca as informações nas linhas da tabela
            $this->table->add_row($add_row);
        }
        echo $this->table->generate();
        ?>
    </div>
</div>