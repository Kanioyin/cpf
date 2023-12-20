<?php

/** @var \App\Model\impreza $impreza */
/** @var \App\Service\Router $router */

$title = "{$impreza->getSubject()} ({$impreza->getId()})";
$bodyClass = 'show';

ob_start(); ?>
    <h1><?= $impreza->getSubject() ?></h1>
    <article>
        <?= $impreza->getContent();?>
    </article>
    <h3><?= $impreza->getDate() ?></h3>
    <ul class="action-list">
        <li> <a href="<?= $router->generatePath('impreza-index') ?>">Powrót do imprez</a></li>
        <li><a href="<?= $router->generatePath('impreza-edit', ['id'=> $impreza->getId()]) ?>">Edycja</a></li>
    </ul>
<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
