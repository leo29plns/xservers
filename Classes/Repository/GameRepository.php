<?php

namespace lightframe\Repository;

use lightframe\Entity\Game;
use lightframe\Entity\Server;

class GameRepository
{
    private $gameEntity;

    public function __construct(Game $gameEntity)
    {
        $this->gameEntity = $gameEntity;
    }

    public function set() : void
    {
        if (!isset($_SESSION['game'])) {
            $_SESSION['game'] = [
                'player' => serialize($this->gameEntity->player),
                'enemy' => serialize($this->gameEntity->enemy)
            ];
        }
    }

    public function get() : ?bool
    {
        if (isset($_SESSION['game'])) {
            $this->gameEntity->hydrate([
                'player' => unserialize($_SESSION['game']['player'], ['allowed_classes' => [Server::class]]),
                'enemy' => unserialize($_SESSION['game']['enemy'], ['allowed_classes' => [Server::class]])
            ]);

            return true;
        } else {
            return null;
        }
    }

    public function update() : void
    {
        if (isset($_SESSION['game'])) {
            $_SESSION['game'] = array_merge($_SESSION['game'], [
                'player' => serialize($this->gameEntity->player),
                'enemy' => serialize($this->gameEntity->enemy)
            ]);
        }
    }

    public function delete() : void
    {
        unset($_SESSION['game']);
    }
}