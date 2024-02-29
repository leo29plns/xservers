<?php

namespace lightframe\Repository;

use lightframe\Db;
use lightframe\Entity\Brand;

class BrandRepository
{
    private $db;
    private $brandEntity;

    public function __construct(Brand $brandEntity)
    {
        $this->db = new Db();
        $this->brandEntity = $brandEntity;
    }

    public function getById(int $id) : Server
    {
        $stmt = $this->db->prepare("SELECT id FROM Brand WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    }
}