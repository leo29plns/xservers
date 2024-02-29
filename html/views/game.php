<?php

    $this->setTitle('Jeu');
    $this->setDescription('Jeu');
    $this->addCss('game.css');

?>

<h1 class="title">Interface réseau - <?= SITE_NAME ?> <?= SITE_VERSION ?></h1>

<div class="enemy">
    <div>
        <div class="identity">
            <h2><?= $this->entities['game']->enemy->name ?></h2>
            <p>Adversaire</p>
        </div>
        <div class="status">
            <p>PWR <span class="power"><?= $this->entities['game']->enemy->power ?></span>G</p>
            <p>REP <?= $this->entities['game']->enemy->repairability ?>/10</p>
            <p>BUG -<?= $this->entities['game']->enemy->bugs ?></p>
        </div>
    </div>
    <div class="board">
        <p>
            <?php
                if ($this->entities['game']->botLastMoveIsAttack) {
                    $messageList = [
                        "{$this->entities['game']->enemy->name} vous attaque.",
                        "{$this->entities['game']->enemy->name} décide de vous attaquer.",
                        "{$this->entities['game']->enemy->name} vous a envoyé des bugs.",
                        "{$this->entities['game']->enemy->name} attaque {$this->entities['game']->player->name}."
                    ];
                } else {
                    $messageList = [
                        "{$this->entities['game']->enemy->name} se répare.",
                        "{$this->entities['game']->enemy->name} décide de se réparer",
                        "{$this->entities['game']->enemy->name} opte pour de meilleurs composants."
                    ];
                }

                echo $messageList[array_rand($messageList)];
            ?>
        </p>
    </div>
</div>

<div class="player">
    <div class="identity">
        <h2><?= $this->entities['game']->player->name ?></h2>
        <p>Vous</p>
    </div>

    <div class="footer">
        <div class="status">
            <p>PWR <?= $this->entities['game']->player->power ?>G</p>
            <p>REP <?= $this->entities['game']->player->repairability ?>/10</p>
            <p>BUG -<?= $this->entities['game']->player->bugs ?></p>
        </div>
        <div class="actions">
            <form method="POST">
                <input type="hidden" name="ACTION" value="attack">
                <input type="submit" value="<Attaquer>">
            </form>
            <form method="POST">
                <input type="hidden" name="ACTION" value="repair">
                <input type="submit" value="<Se réparer>">
            </form>
        </div>
    </div>
</div>

<nav class="bottom-nav">
    <form method="POST">
        <input type="hidden" name="ACTION" value="quit">
        <input type="submit" value="<Abandonner la partie>">
    </form>
</nav>