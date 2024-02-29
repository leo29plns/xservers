<?php

    $this->setTitle('Configuration');
    $this->setDescription('Configuration');
    $this->addCss('configuration/editor.css');
    $this->addJs('configuration/strpad.js');
    $this->addJs('configuration/form.js');

?>

<h1 class="title">Configuration</h1>

<form method="POST" id="edit-server" class="edit-server">
    <div class="input">
        <label for="name">Modèle :</label>
        <input type="text" name="name" id="name" class="pad--end">
    </div>
    <div class="input">
        <label for="power">PWR :</label>
        <input type="number" name="power" id="power" min="10" max="10000">
    </div>
    <div class="input">
        <label for="repairability">REP :</label>
        <input type="number" name="repairability" id="repairability" min="0" max="10">
    </div>
    <div class="input">
        <label for="bugs">BUG :</label>
        <input type="number" name="bugs" id="bugs" min="5" max="5000">
    </div>
    <input type="hidden" name="ACTION" value="addServer">
</form>

<nav class="bottom-nav">
    <input type="submit" form="edit-server" value="<Créer>">
    <a href="<?= $_ENV['BASE_LINK'] . 'configuration' ?>">Retour</a>
</nav>