<?php

    $this->setTitle('Configuration');
    $this->setDescription('Configuration');
    $this->addCss('configuration/editor.css');
    $this->addJs('configuration/strpad.js');
    $this->addJs('configuration/form.js');

?>

<h1 class="title">Configuration</h1>

<p class="danger">Êtes-vous certain(e) de vouloir supprimer <?= $this->entities['server']->name ?> ?</p>

<nav class="bottom-nav">
<a href="<?= $_ENV['BASE_LINK'] . 'configuration' ?>">Annuler</a>
    <form method="POST">
        <input type="hidden" name="ACTION" value="deleteServer">
        <input type="hidden" name="id" value="<?= $this->entities['server']->id ?>">
        <input type="submit" value="<Supprimer>">
    </form>
    <a href="<?= $_ENV['BASE_LINK'] . 'configuration' ?>">Retour</a>
</nav>