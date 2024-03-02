<?php



?>
<li>
    <form method="POST">
        <input type="hidden" name="ACTION" value="select">
        <input type="hidden" name="id" value="<?= $server->id ?>">
        <button type="submit">
            <h1><?= $server->name ?></h1>
            <p><?= str_pad('', 30 - mb_strlen($server->name), '.') ?>..<?= str_pad($server->power, 5, '.', STR_PAD_LEFT) ?>..<?= str_pad($server->repairability, 2, '.', STR_PAD_LEFT) ?>..<?= str_pad('-' . $server->bugs, 5, '.', STR_PAD_LEFT) ?></p>
        </button>
    </form>
</li>