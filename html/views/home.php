<?php

    $this->setTitle('Accueil');
    $this->setDescription('Accueil');
    $this->addCss('home.css');

?>

<h1 class="title">X Servers</h1>
<ul>
    <li><a href="<?= $_ENV['BASE_LINK'] . 'jeu' ?>">Jouer</a></li>
    <li><a href="<?= $_ENV['BASE_LINK'] . 'configuration' ?>">Configurer</a></li>
</ul>