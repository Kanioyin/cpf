<?php

/** @var \App\Model\impreza[] $imprezy */
/** @var \App\Service\Router $router */

$title = 'Lista imprez';
$bodyClass = 'index';

ob_start(); ?>
    <h1>Lista Imprez</h1>

    <a href="<?= $router->generatePath('impreza-create') ?>">Dodaj imprezę</a>

    <ul class="index-list">
        <?php foreach ($imprezy as $impreza): ?>
            <li><h3><?= $impreza->getSubject() ?></h3>
                <ul class="action-list">
                    <li><a href="<?= $router->generatePath('impreza-show', ['id' => $impreza->getId()]) ?>">Detale</a></li>
                    <li><a href="<?= $router->generatePath('impreza-edit', ['id' => $impreza->getId()]) ?>">Edycja</a></li>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
