<?php

namespace lightframe\Controllers;

use lightframe\{SessionController, ViewBuilder, Components};
use lightframe\Entity\{Brand, Server, Game};
use lightframe\Repository\{BrandRepository, ServerRepository, GameRepository};

class GameController
{
    public function pageJeu() : void
    {
        $game = new Game();
        $gameRepository = new GameRepository($game);

        if (!$gameRepository->get()) {
            header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/selection');
            exit;
        }

        if ($game->lifeCheck()) {
            header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/fin');
            exit;
        }

        if (isset($_POST['ACTION'])) {
            switch ($_POST['ACTION']) {
                case 'quit':
                    $gameRepository->delete();

                    header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/selection');
                    exit;
                    break;
                case 'attack':
                    $game->player->attack($game->enemy);
                    break;
                case 'repair':
                    $game->player->repair();
                    break;
            }

            $gameRepository->update();

            if ($game->lifeCheck()) {
                header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/fin');
                exit;
            }

            $attack = false;

            $randomNumber = mt_rand(0, 100);
            if ($randomNumber <= $game->difficulty * 100) {
                if ($game->advantagesCheck() === $game->enemy) {
                    $attack = true;
                }
            } else {
                if ($game->advantagesCheck() !== $game->enemy) {
                    $attack = true;
                }
            }

            if ($attack) {
                $game->enemy->attack($game->player);
                $game->setBotLastMoveIsAttack(true);
            } else {
                $game->enemy->repair();
                $game->setBotLastMoveIsAttack(false);
            }
        }

        $gameRepository->update();

        if ($game->lifeCheck()) {
            header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/fin');
            exit;
        }
        
        $html = new ViewBuilder('game.php');
        $html->entities['game'] = $game;

        echo $html->render();
    }

    public function pageSelection() : void
    {
        $game = new Game();
        $gameRepository = new GameRepository($game);

        $player = new Server();
        $playerRepository = new ServerRepository($player);

        $enemy = new Server();
        $enemyRepository = new ServerRepository($enemy);

        if ($gameRepository->get()) {
            header('Location: ' . $_ENV['BASE_LINK'] . 'jeu');
            exit;
        }

        if (isset($_POST['ACTION'])) {
            switch ($_POST['ACTION']) {
                case 'select':
                    if (isset($_POST['player'], $_POST['enemy'])) {
                        $playerRepository->getById((int) $_POST['player']);
                        $enemyRepository->getById((int) $_POST['enemy']);

                        $game->setPlayer($player);
                        $game->setEnemy($enemy);

                        $gameRepository->set();

                        header('Location: ' . $_ENV['BASE_LINK'] . 'jeu');
                        exit;
                    }
                    break;
            }
        }

        $server = new Server();
        $serverRepository = new ServerRepository($server);

        $servers = $serverRepository->getServers();
        
        $html = new ViewBuilder('game/selection.php');
        $html->components['servers'] = new Components\Views\Game\Selection\ServerCardSelector($html);

        foreach ($servers as $server) {
            $html->components['servers']->addServer($server);
        }

        echo $html->render();
    }

    public function pageFin() : void
    {
        $game = new Game();
        $gameRepository = new GameRepository($game);

        if (!$gameRepository->get()) {
            header('Location: ' . $_ENV['BASE_LINK'] . 'jeu/selection');
            exit;
        }

        if (isset($_POST['ACTION'])) {
            switch ($_POST['ACTION']) {
                case 'end':
                    $gameRepository->delete();

                    header('Location: ' . $_ENV['BASE_LINK'] . '');
                    exit;

                    break;
            }
        }
        
        $html = new ViewBuilder('game/end.php');
        $html->entities['game'] = $game;

        echo $html->render();
    }
}