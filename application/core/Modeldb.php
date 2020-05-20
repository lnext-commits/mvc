<?php
namespace Core;

use PDO;

class Modeldb
{
    protected $user;
    protected $pass;
    protected $dsn;
    protected $opt;
    protected $pdo;

    protected function start()
    {
        $dp = include CONFIG_DIR . "setingdb.php";

        $this->dsn = "mysql:host=$dp[hostname];dbname=$dp[database];charset=$dp[char_set]";
        $this->opt = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $this->user = $dp['username'];
        $this->pass = $dp['password'];
    }

    protected function createPDO()
    {
        $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->opt);
    }

    public function getPDO()
    {
        $this->createPDO();
        return $this->pdo;
    }
}
