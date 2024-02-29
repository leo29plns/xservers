<?php

namespace lightframe\Entity;

class Server
{
    public $id;
    public $name;
    
    public $power;
    public const MAX_POWER = 10000; 
    public const MIN_POWER = 10; 

    public $repairability;
    public const MAX_REPAIRABILITY = 10; 
    public const MIN_REPAIRABILITY = 1; 

    public $bugs;
    public const MAX_BUGS = 5000; 
    public const MIN_BUGS = 5;

    public function __construct(array $data = [])
    {
        $this->hydrate($data);
    }

    private static function repairScale(int $x) : int
    {
        return 5 * pow($x, 3);
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

    public function setId(int $id) : void
    {
        if ($id >= 0) {
            $this->id = $id;
        } else {
            throw new \InvalidArgumentException('Must be positive.');
        }
    }

    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function setPower(int $power) : void
    {
        if ($power <= self::MAX_POWER && $power >= self::MIN_POWER) {
            $this->power = $power;
        } else {
            throw new \InvalidArgumentException('Must be in range [' . self::MIN_POWER . ';' . self::MAX_POWER . '].');
        }
    }

    public function setRepairability(int $repairability) : void
    {
        if ($repairability <= self::MAX_REPAIRABILITY && $repairability >= self::MIN_REPAIRABILITY) {
            $this->repairability = $repairability;
        } else {
            throw new \InvalidArgumentException('Must be in range [' . self::MIN_REPAIRABILITY . ';' . self::MAX_REPAIRABILITY . '].');
        }
    }

    public function setBugs(int $bugs) : void
    {
        if ($bugs <= self::MAX_BUGS && $bugs >= self::MIN_BUGS) {
            $this->bugs = $bugs;
        } else {
            throw new \InvalidArgumentException('Must be in range [' . self::MIN_BUGS . ';' . self::MAX_BUGS . '].');
        }
    }

    public function attack(Server $enemy) : void
    {
        $newPower = $enemy->power - $this->bugs;

        if ($newPower >= $enemy::MIN_POWER) {
            $enemy->setPower($newPower);
        } else {
            $enemy->setPower($enemy::MIN_POWER);
        }
    }

    public function repair() : void
    {
        $newPower = $this->power + self::repairScale($this->repairability);

        if ($newPower <= self::MAX_POWER) {
            $this->setPower($newPower);
        } else {
            $this->setPower(self::MAX_POWER);
        }
    }
}