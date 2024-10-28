<?php

namespace Core;

use PDO;

// TODO: add functionality to connect DB
// TODO: integrate ORM
// TODO: implement DB migration system

class Model {
    protected $pdo;

    protected $config;

    public function __construct() {

        $config = require_once('../config/config.php');

        $this->pdo = new PDO("mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}", "{$config['db']['user']}", "{$config['db']['password']}");
    }

    public function query($sql, $params = []) {
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
