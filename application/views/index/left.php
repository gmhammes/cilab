<?php if (isset($itens_menu)): ?>
    <?php foreach ($itens_menu as $item): ?>
        <div id="botMenu">
            <?= anchor($item->str_url, $item->str_titulo); ?>
        </div>
    <?php endforeach; ?>
<?php endif; ?>