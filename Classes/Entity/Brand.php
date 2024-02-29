<?php

namespace lightframe\Entity;

class Server
{
    public $id;
    public $name;
    
    public $color;

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

    public function setColor(string $color) : void
    {
        $color = strtoupper($color);
        
        if (preg_match('/^[0-9A-F]{3}$/i', $color)) {
            $color = $color[0] . $color[0] . $color[1] . $color[1] . $color[2] . $color[2];
        }

        if (preg_match('/^[0-9A-F]{6}$/i', $color)) {
            $this->color = $color;
        } else {
            throw new \InvalidArgumentException('Invalid color format. Must be a 6-character hexadecimal color code.');
        }
    }
}