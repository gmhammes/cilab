
<?php

echo form_open($dadosFormOpen);
$data = array(
    'name' => 'bol_ativo',
    'id' => 'bol_ativo',
);
echo "<div>";
echo form_checkbox($data) . "{Equip Ativo} ";
echo "</div>";
echo "\n";
$dados = array(
    'name' => 'submit',
    'tabindex' => 1
);
echo form_submit($dados, 'submit');
echo "\n";
form_close();
?>

