<?php

    $this->setTitle('Jeu');
    $this->setDescription('Jeu');
    $this->addCss('game/selection.css');
    $this->addJs('game/selectServers.js');

?>

<h1 class="title">Sélection des personnages</h1>

<section class="servers-selector">
    <form method="POST">
        <p class="instruction player">Sélectionnez <span class="player">votre</span> serveur.</p>
        <p class="instruction enemy">Sélectionnez le serveur <span class="enemy">adverse</span>.</p>
        <p class="instruction ready">Vous pouvez commencer la partie.</p>
        <fieldset class="servers-list">
            <?= $this->components['servers']->render() ?>
        </fieldset>

        <input type="hidden" name="ACTION" value="select">
        <nav class="bottom-nav">
            <input type="submit" value="<Jouer>">
            <a href="<?= $_ENV['BASE_LINK'] . '' ?>">Accueil</a>
        </nav>
    </form>
</section>