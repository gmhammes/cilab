    <div>
        <div style="background-image: url(<?= base_url('assets/img/titulo') ?><?= ($this->input->cookie('sistema', false)) ? ('/' . $this->input->cookie('sistema', false)) : (NULL); ?>.jpg); background-repeat: no-repeat; height: 100px; background-position: center center">       
        </div>
        <div>
            <?php if ($this->session->userdata('str_nome')): ?>
                Olá <?= $this->session->userdata('str_nome'); ?>, Você pode utilizar o sistema<?= ($this->input->cookie('sistema', false)) ? ': ' . $this->input->cookie('sistema', false) : NULL; ?>
            <?php endif; ?>
        </div>
    </div>

