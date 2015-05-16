<html>
    <head>
        <?php
        // C:\xampp\htdocs\cilab\v1\cilab\application\views\index\index.php
        ($this->uri->segment(3) == 'login-on') ? ($alerta = "Bem vindo!") : (NULL);
        ($this->uri->segment(3) == 'login-off') ? ($alerta = "Falha no Login!") : (NULL);
        ($this->uri->segment(3) == 'password-off') ? ($alerta = "Senhas não são iguais!") : (NULL);
        ($this->uri->segment(3) == 'insert-ok') ? ($alerta = "Sucesso no cadastro!") : (NULL);
        ($this->uri->segment(3) == 'change-password-on') ? ($alerta = "Senha alterada com sucesso! \n Favor entrar com sua nova senha.") : (NULL);
        ($this->uri->segment(3) == 'change-password-off') ? ($alerta = "Falha na troca da senha.") : (NULL);
        ($this->uri->segment(3) == 'cadastro-ok') ? ($alerta = "Cadastro realizado com sucesso!") : (NULL);
        ($this->uri->segment(4) == 'cadastro-ok') ? ($alerta = "Cadastro realizado com sucesso!") : (NULL);
        if ($alerta !== NULL) {
            echo "<SCRIPT LANGUAGE=" . '"' . "JavaScript" . '"' . " TYPE=" . '"' . "text/javascript" . '"' . ">";
            echo "alert (" . '"' . "{$alerta}" . '"' . ");";
            echo "</script>";
        }
        ?>
        <script type="text/javascript">
            function noBack() {
                window.history.forward()
            }
            noBack();
            window.onload = noBack;
            window.onpageshow = function (evt) {
                if (evt.persisted)
                    noBack()
            }
            window.onunload = function () {
                void(0)
            }
            //–>
            onKeyDown = "if (event.keyCode == '13'){ return false }"
        </script>
        <?php
        $meta = array(
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'description', 'content' => 'Habilidades de todos os tipos'),
            array('name' => 'keywords', 'content' => 'política, artezanato, culinária, diversão, gastronomia'),
            array('name' => 'robots', 'content' => 'no-cache'),
            array('name' => 'Content-type', 'content' => 'text/html; charset=utf-8', 'type' => 'equiv')
        );
        echo meta($meta);
        /**
          echo link_tag('caminho/do/icone/do/site', 'shortcut icon', 'iamge/ico');
          echo link_tag('caminho/do/css/da/pagina');
          /* */
        ?>
        <title><?= $dadosEstilo['titulo_pagina']; ?></title>
        <style>
<?php
if (isset($dadosEstilo['arquivos_css']) || isset($dadosEstilo['caminho_css'])) {
    foreach ($dadosEstilo['arquivos_css'] as $arqCSS) {
        include_once ($dadosEstilo['caminho_css'] . $arqCSS . '.css');
    }
}
?>
        </style>
    </head>
    <body onLoad=”javascript:window.clear.history(0)”>
        <div id="tudo">
            <div id="divTop">
                <?php $top['img_top_titulo'] = ($dadosEstilo['img_top_titulo']) ? $dadosEstilo['img_top_titulo'] : NULL; ?><?= $this->load->view('index/top', $top); ?>
            </div>
            <div id="divLeft">
                <?= $this->load->view('index/left'); ?>
            </div>
            <div id="divContent">
                <div style="padding-top: 30px">
                    <?= $this->load->view('index/menu'); ?>
                </div>
                <div style='font-size: 10px; width: 90%;'></div>
                <div>    
                    <?= $this->load->view($this->uri->segment(1) . '/' . $this->uri->segment(2)); ?>
                </div>
            </div>
            <div id="divRight">
                <?= $this->load->view('index/right'); ?>
            </div>
            <div id="divBottom">
                <?= $this->load->view('index/bottom'); ?>
            </div>
        </div>
    </body>
</html>