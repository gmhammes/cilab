<?php
if ($this->uri->segment(1) == 'Equipamento') {
    $atts = array(
        'width' => '500',
        'height' => '400',
        'scrollbars' => 'yes',
        'status' => 'yes',
        'resizable' => 'yes',
        'screenx' => '40',
        'screeny' => '40'
    );
} elseif ($this->uri->segment(1) == 'Funcioionario') {
    $atts = array(
        'width' => '740',
        'height' => '600',
        'scrollbars' => 'yes',
        'status' => 'yes',
        'resizable' => 'yes',
        'screenx' => '0',
        'screeny' => '0'
    );
} else {
    $atts = array(
        'width' => '740',
        'height' => '600',
        'scrollbars' => 'yes',
        'status' => 'yes',
        'resizable' => 'yes',
        'screenx' => '0',
        'screeny' => '0'
    );
}
?>
<div id='cssmenu'>
    <ul>
        <li class='has-sub'><?= anchor(base_url() . "index/resumo", "Principal"); ?>
            <ul>
                <?php if ($this->session->userdata('logado')): ?>
                    <li class='has-sub'><?= anchor(base_url() . "Autenticar/logout", "Sair"); ?></li>
                <?php else: ?>
                    <li class='has-sub'><?= anchor(base_url() . "Autenticar/logar", "Entrar"); ?></li>
                    <li class='has-sub'><?= anchor(base_url() . "Usuario/cadastrar", "Cadastrar"); ?></li>
                <?php endif; ?>
            </ul>
        </li>
        <li class='has-sub'><?= anchor(base_url("Termo/Listar"), "Termos"); ?>
            <ul>
                <li class='has-sub'><?= anchor(base_url("Termo/novoTermo"), "Novo"); ?></li>
                <li class='has-sub'><?= anchor(base_url("Termo/Buscar"), "Buscar"); ?></li>
                <li class='has-sub'><?= anchor(base_url("Termo/Listar"), "Listar"); ?></li>
            </ul>
        </li>
        <li class='has-sub'><?= anchor(current_url(), "Equipamento"); ?>
            <ul>
                <li class='has-sub'><?= anchor(base_url("Equipamento/listar/0/65"), "Listar"); ?></li>
                <li class='has-sub'><?= anchor(base_url("Equipamento/cadastrar"), "Cadastrar"); ?>
                    <ul>    
                        <li class='has-sub'><?= anchor_popup(base_url("Marca/cadastrar"), 'Marca', $atts); ?></li>
                        <li class='has-sub'><?= anchor_popup(base_url("Modelo/cadastrar"), 'Modelo', $atts); ?></li>
                        <li class='has-sub'><?= anchor_popup(base_url("Tipo/cadastrar"), 'Tipo', $atts); ?></li>
                    </ul>
                </li>
                <li class='has-sub'><?= anchor(base_url("Equipamento/atualizar"), "Atualizar"); ?></li>
            </ul>
        </li>
        <li class='has-sub'><?= anchor(current_url(), "Funcion&aacute;rio"); ?>
            <ul>
                <li class='has-sub'><?= anchor(base_url("Funcionario/listar/0/65"), "Listar"); ?></li>
                <li class='has-sub'><?= anchor(base_url("Funcionario/cadastrar"), "Cadastrar"); ?></li>
                <li class='has-sub'><?= anchor(base_url("Funcionario/atualizar"), "Atualizar"); ?></li>
            </ul>
        </li>
        <?php if ($this->uri->segment(3) == 'menu'): ?>
            <li class='has-sub'><?= anchor(current_url(), "Menu"); ?>
                <ul>
                    <li class='has-sub'><?= anchor(current_url(), "Sub-Menu"); ?>
                        <ul>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                        </ul>
                    </li>
                    <li class='has-sub'><?= anchor(current_url(), "Sub-Menu"); ?>
                        <ul>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                            <li><?= anchor_popup(base_url("Sub-Menu/Sub-Menu"), 'Sub-Menu', $atts); ?></li>
                        </ul>
                    </li>
                </ul>
            </li>
        <?php endif; ?>
        <li class='has-sub'><?= anchor(current_url(), "Suporte"); ?>
            <ul>
                <li><?= anchor_popup('http://speedtest.copel.net/', 'Conex&atilde;o', $atts); ?></li>
                <li><?= anchor_popup('http://download.teamviewer.com/download/TeamViewerQS_pt.exe', 'TeamViewer', $atts); ?></li>
                <li><?= anchor_popup('http://habilidade.com/_Downloads/LogMeIn.msi', 'LogMeIn', $atts); ?></li>
            </ul>
        </li>
    </ul>
</div>