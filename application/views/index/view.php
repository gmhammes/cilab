<html>
    <head>
        <meta charset="UTF-8">
        <link rel="shortcut icon" href="/<?= (isset($str_pagina_caminnho_icone_fav)) ? $str_pagina_caminnho_icone_fav : NULL ?><?= (isset($str_pagina_arquivo_icone_fav)) ? $str_pagina_arquivo_icone_fav : NULL ?>">
        <link rel="apple-touch-icon" href="/<?= (isset($str_pagina_caminnho_icone_titu)) ? $str_pagina_caminnho_icone_titu : NULL ?><?= (isset($str_pagina_arquivo_icone_titu)) ? $str_pagina_arquivo_icone_titu : NULL ?>"/>
        <link rel="stylesheet" type="text/css" href="<?= (isset($str_css_caminho) ? $str_css_caminho : NULL . (isset($str_css_arquivo)) ? $str_css_arquivo : NULL) ?>">
        <title><?= (isset($str_pagina_nome)) ? $str_pagina_nome : NULL ?></title>
    </head>
    <body>
        <div id="tudo">
            <div id="divTop">
                <?= $this->load->view('index/top'); ?>
            </div>
            <div id="divLeft">
                <?= $this->load->view('index/left'); ?>
            </div>
            <div id="divContent">
                <?= $this->load->view('index/barraFerramentas'); ?>
                <?= $this->load->view(isset($str_view) ? $str_view : 'index/index'); ?>
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
