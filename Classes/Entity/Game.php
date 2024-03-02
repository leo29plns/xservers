<?php

namespace lightframe\Entity;

use lightframe\Entity\Server;

class Game
{
    public $player;
    public $enemy;

    public $difficulty = 0.75;
    public $botLastMoveIsAttack;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    public function hydrate(array $data) : void
    {
        foreach ($data as $property => $value) {
            $method = 'set' . ucfirst($property);  
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setPlayer(Server $player) : void
    {
        $this->player = $player;
    }

    public function setEnemy(Server $enemy) : void
    {
        $this->enemy = $enemy;
    }

    public function setBotLastMoveIsAttack(bool $attack) : void
    {
        $this->botLastMoveIsAttack = $attack;
    }

    public function lifeCheck() : ?Server
    {
        if ($this->enemy->power === $this->enemy::MIN_POWER) {
            return $this->enemy;
        } elseif ($this->player->power === $this->player::MIN_POWER) {
            return $this->player;
        } else {
            return null;
        }
    }

    public function advantagesCheck() : ?Server
    {
        if ($this->enemy->power >= $this->player->power) {
            return $this->enemy;
        } else {
            return $this->player;
        }
    }
}