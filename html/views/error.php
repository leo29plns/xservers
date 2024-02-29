<?php

    $this->setDescription('Une erreur est survenue.');
    $this->addCss('error.css');

?>
<section class="error">
    <div>
        <h1>Erreur <?= $this->layout['error']['code'] ?></h1>
        <p><?= $this->layout['error']['message'] ?></p>
        <a href="<?= $_ENV['BASE_LINK'] . '' ?>">Accueil</a>
    </div>
</section>