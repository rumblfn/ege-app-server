<?php

namespace app\engine;

use app\models\Basket;
use app\traits\TSingletone;

class Db
{
    private $config;

    private $connection = null; //PDO

    public function __construct($driver = null, $host = null, $login = null, $password = null, $database = null, $charset = "utf8")
    {
        $this->config['driver'] = $driver;
        $this->config['host'] = $host;
        $this->config['login'] = $login;
        $this->config['password'] = $password;
        $this->config['database'] = $database;
        $this->config['charset'] = $charset;
    }

    private function getConnection(): \PDO
    {
        if (is_null($this->connection)) {
            $this->connection = new \PDO($this->prepareDsnString(),
                $this->config['login'],
                $this->config['password']
            );
            $this->connection->setAttribute(\PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_ASSOC);
        }
        return $this->connection;

    }

    public function lastInsertId()
    {
        return $this->getConnection()->lastInsertId();
    }

    private function prepareDsnString(): string
    {
        return sprintf("%s:host=%s;dbname=%s;charset=%s",
            $this->config['driver'],
            $this->config['host'],
            $this->config['database'],
            $this->config['charset']
        );
    }

    private function query($sql, $params) {
        $STH = $this->getConnection()->prepare($sql);
        $STH->execute($params);
        return $STH;
    }

    public function queryOneObject($sql, $params, $class)
    {
        $STH = $this->query($sql, $params);
        $STH->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, $class);
        return $STH->fetch();
    }

    public function queryOne($sql, $params = [])
    {
        return $this->query($sql, $params)->fetch();
    }

    public function queryAll($sql, $params = [])
    {
        return $this->query($sql, $params)->fetchAll();
    }

    public function queryLimit($sql, $limit) {
        $STH = $this->getConnection()->prepare($sql);
        $STH->bindValue(1, $limit, \PDO::PARAM_INT);
        $STH->execute();
        return $STH->fetchAll();
    }

    public function execute($sql, $params = []): int
    {
        return $this->query($sql, $params)->rowCount();
    }


}