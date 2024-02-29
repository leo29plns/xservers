<?php

namespace lightframe\Repository;

use lightframe\Db;
use lightframe\Entity\Server;

class ServerRepository
{
    private $db;
    private $serverEntity;

    private $brandRepository;

    public function __construct(Server $serverEntity)
    {
        $this->db = new Db();
        $this->serverEntity = $serverEntity;
    }

    public function getById(int $id) : ?bool
    {
        $stmt = $this->db->prepare('SELECT * FROM Server WHERE id = :id');
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($result) {
            $this->serverEntity->hydrate($result);
            return true;
        } else {
            return null;
        }
    }

    public function getServers(int $limit = 50) : ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM Server ORDER BY id DESC LIMIT :limit');
        $stmt->bindParam(':limit', $limit, \PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        $servers = [];
        foreach ($result as $rawServer) {
            $server = new Server();
            $server->hydrate($rawServer);
            $servers[] = $server;
        }

        return $result ? $servers : null;
    }

    public function update() : ?bool
    {
        $stmt = $this->db->prepare('UPDATE Server SET name = :name, power = :power, repairability = :repairability, bugs = :bugs WHERE id = :id');
        $stmt->bindParam(':id', $this->serverEntity->id, \PDO::PARAM_INT);
        $stmt->bindParam(':name', $this->serverEntity->name, \PDO::PARAM_STR);
        $stmt->bindParam(':power', $this->serverEntity->power, \PDO::PARAM_INT);
        $stmt->bindParam(':repairability', $this->serverEntity->repairability, \PDO::PARAM_INT);
        $stmt->bindParam(':bugs', $this->serverEntity->bugs, \PDO::PARAM_INT);

        return $stmt->execute() ? true : null;
    }

    public function insert() : ?bool
    {
        $stmt = $this->db->prepare('INSERT INTO Server (name, power, repairability, bugs, brand) VALUES (:name, :power, :repairability, :bugs, 1)');
        $stmt->bindParam(':name', $this->serverEntity->name, \PDO::PARAM_STR);
        $stmt->bindParam(':power', $this->serverEntity->power, \PDO::PARAM_INT);
        $stmt->bindParam(':repairability', $this->serverEntity->repairability, \PDO::PARAM_INT);
        $stmt->bindParam(':bugs', $this->serverEntity->bugs, \PDO::PARAM_INT);

        return $stmt->execute() ? true : null;
    }

    public function delete() : ?bool
    {
        $stmt = $this->db->prepare('DELETE FROM Server WHERE id = :id');
        $stmt->bindParam(':id', $this->serverEntity->id, \PDO::PARAM_INT);

        return $stmt->execute() ? true : null;
    }
}