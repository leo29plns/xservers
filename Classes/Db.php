<?php

namespace lightframe;

use PDO;

class Db extends PDO
{
    public function __construct()
    {
        $dbHost = $_ENV['DB_HOST'];
        $dbName = $_ENV['DB_NAME'];
        $dbUser = $_ENV['DB_USER'];
        $dbPassword = $_ENV['DB_PASSWORD'];

        $dsn = "mysql:host=$dbHost;dbname=$dbName";

        try {
            parent::__construct($dsn, $dbUser, $dbPassword);

            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            \lightframe\Error::throw(500, 'Connexion impossible à la base de données. (' . $e->getMessage() . ').');
        }
    }
}
