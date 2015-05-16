<div>
    <?php
    if (isset($this->session->userdata)) {
        echo $this->session->userdata('logado');
        echo "<br />";
        echo "Chave Alternada: " . $str_chave;
        echo "<br />";
        echo "Chave LOGON: " . $this->session->userdata('str_pk_logon');
        echo "<br />";
        echo "Chave Usuário: " . $this->session->userdata('str_pk_usuario');
        echo "" . "<br />";
        echo "Usuário Bloqueado: " . $this->session->userdata('bol_bloqueado');
        echo "" . "<br />";
        echo "Nome do Usuário: " . $this->session->userdata('str_nome');
        echo "" . "<br />";
        echo "Login: " . $this->session->userdata('str_login');
        echo "" . "<br />";
        echo "Sistema: " . $this->session->userdata('str_sistema');
        echo "" . "<br />";
        echo "Responsável: " . $this->session->userdata('str_responsavel');
        echo "" . "<br />";
        echo "Data de Criação: " . $this->session->userdata('dtm_data');
        echo "" . "<br />";
        echo "Hora da Criação: " . $this->session->userdata('dtm_hora');
    }
    ?>
</div>