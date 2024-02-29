<?php

    $this->setTitle('Configuration');
    $this->setDescription('Configuration');
    $this->addCss('configuration.css');

?>

<h1 class="title">Configuration</h1>

<p class="desc">PWR&nbsp;&nbsp;&nbsp;REP&nbsp;&nbsp;&nbsp;BUG</p>
<ul class="servers">
    <?= $this->components['servers']->render() ?>
</ul>

<nav class="bottom-nav">
    <form method="POST">
        <input type="hidden" name="ACTION" value="add">
        <input type="submit" value="<Ajouter>">
    </form>
    <a href="<?= $_ENV['BASE_LINK'] . '' ?>">Accueil</a>
</nav>