<?php

/** @var \App\Model\impreza $impreza */
/** @var \App\Service\Router $router */

$title = "Edit impreza {$impreza->getSubject()} ({$impreza->getId()})";
$bodyClass = "edit";

ob_start(); ?>
    <h1><?= $title ?></h1>
    <form action="<?= $router->generatePath('impreza-edit') ?>" method="post" class="edit-form">
        <?php require __DIR__ . DIRECTORY_SEPARATOR . '_form.html.php'; ?>
        <input type="hidden" name="action" value="impreza-edit">
        <input type="hidden" name="id" value="<?= $impreza->getId() ?>">
    </form>

    <ul class="action-list">
        <li>
            <a href="<?= $router->generatePath('impreza-index') ?>">Back to Events</a></li>
        <li>
            <form action="<?= $router->generatePath('impreza-delete') ?>" method="post">
                <input type="submit" value="Delete" onclick="return confirm('Jesteś pewny?')">
                <input type="hidden" name="action" value="impreza-delete">
                <input type="hidden" name="id" value="<?= $impreza->getId() ?>">
            </form>
        </li>
    </ul>

<?php $main = ob_get_clean();

include __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'base.html.php';
