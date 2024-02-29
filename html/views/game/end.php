<?php

    $this->setTitle('Jeu');
    $this->setDescription('Jeu');
    $this->addCss('game/end.css');

?>

<h1 class="title">Partie terminée</h1>

<h2><?= ($this->entities['game']->lifeCheck() === $this->entities['game']->enemy) ? "Vous avez gagné !" : "Vous avez perdu." ?></h2>

<p><?= ($this->entities['game']->lifeCheck())->name ?> remporte la partie.</p>

<nav class="bottom-nav">
    <form method="POST">
        <input type="hidden" name="ACTION" value="end">
        <input type="submit" value="<Terminer>">
    </form>
    <a href="<?= $_ENV['BASE_LINK'] . '' ?>">Accueil</a>
</nav>