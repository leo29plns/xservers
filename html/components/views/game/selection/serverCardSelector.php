<?php



?>
<input type="checkbox" id="server<?= $server->id ?>" name="<?= $server->id ?>">
<label for="server<?= $server->id ?>">
    <h2><?= $server->name ?></h2>
    <p>PWR <?= $server->power ?>G</p>
    <p>REP <?= $server->repairability ?>/10 </p>
    <p>BUG -<?= $server->bugs ?>G</p>
</label>