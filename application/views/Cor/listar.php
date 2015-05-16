<?php
// $this->dc->ep($my_dados_DB[0]['tabela']['result']);
?>
<div class="tituloAplicacao">
    <?= $dadosEstilo[0]['titulo_aplicacao']; ?>
</div>
<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\equipamento\listar.php
$url = 'http://localhost/cilab/v2/cilab/Cor/listar/';
$config['base_url'] = $url;
$config['total_rows'] = $my_dados_DB[0]['tabela']['qtd'];
$config['per_page'] = $limit;
$this->pagination->initialize($config);
echo $this->pagination->create_links();
?>
<?php foreach ($my_dados_DB[0]['tabela']['result'] as $value_result): ?>
    <?php
    if ($value_result->str_cod_html == "#000000") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#000080") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#00008B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#0000EE") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#0000FF") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#006400") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#00688B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#00868B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#008B00") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#008B45") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#008B8B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#009ACD") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#104E8B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#1C1C1C") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#1874CD") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#0000CD") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#1C86EE") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#1E90FF") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#228B22") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#27408B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#2E8B57") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#2F4F4F") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#363636") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#191970") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#36648B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#3A5FCD") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#4169E1") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#436EEE") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#458B00") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#458B74") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#4682B4") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#473C8B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#483D8B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8A2BE2") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#CD3333") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#A52A2A") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#EE3B3B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#FF4040") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8B2323") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8B7355") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8B7355") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#5F9EA0") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8B4513") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#53868B") {
        $texto = "#FFFFFF";
    } elseif ($value_result->str_cod_html == "#8B3E2F") {
        $texto = "#FFFFFF";
    } else {
        $texto = "#000000";
    }
    ?>
    <div style="background-color: <?= $value_result->str_cod_html; ?>; color: <?= $texto ?>">
        <div>
            <?= $value_result->str_nome; ?>
        </div>
        <div>
            <?= $value_result->str_cod_java; ?>
        </div>
        <div>
            <?= $value_result->str_cod_html; ?>
        </div>
    </div>
<?php endforeach; ?>
<?php
// C:\xampp\htdocs\cilab\v1\cilab\application\views\equipamento\listar.php
$config['base_url'] = $url;
$config['total_rows'] = $my_dados_DB[0]['tabela']['qtd'];
$config['per_page'] = $limit;
$this->pagination->initialize($config);
echo $this->pagination->create_links();
?>