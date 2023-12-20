<?php

/** @var \App\Model\impreza $post */
/** @var \App\Service\Router $router */

$title = 'Dodawanie imprezy';
$bodyClass = "edit";

ob_start(); ?>
    <h1>Dodawanie imprezy</h1>
    <form action="<?= $router->generatePath('impreza-create') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="impreza-create">
    </form>

    <a href="<?= $router->generatePath('impreza-index') ?>">Powrót do imprez </a>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
