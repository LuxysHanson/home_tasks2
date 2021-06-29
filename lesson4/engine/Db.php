<?php

namespace app\engine;

use PDO;

class Db
{
    protected $connection = null;
    protected $config = [];

    public function __construct()
    {
        $this->config = require __DIR__ . '/../config/db.php';

        /** @var $database array */
        $conn = new PDO($this->prepareDsnString(), $this->config['login'], $this->config['password']);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

        $this->setConnection($conn);
    }

    public function getConnection()
    {
        return $this->connection;
    }

    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    protected function prepareDsnString() {
        return sprintf("mysql:host=%s;dbname=%s;",
            $this->config['host'],
            $this->config['database']
        );
    }

}