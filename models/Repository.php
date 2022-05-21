<?php

namespace app\models;

use app\engine\App;
use app\interfaces\IRepository;

abstract class Repository implements IRepository
{
    protected abstract function getTableName();
    protected abstract function getEntityClass();

    public function getWhere($name, $value) {
        $tableName = $this->getTableName();
        $params[":" . $name] = $value;
        $sql = "SELECT * FROM `{$tableName}` where $name = :$name";
        return App::call()->db->queryOneObject($sql, [$name => $value], $this->getEntityClass());
    }

    public function getAllWhere($name, $value) {
        $tableName = $this->getTableName();
        $params[":" . $name] = $value;
        $sql = "SELECT * FROM `{$tableName}` where $name = :$name";
        return App::call()->db->queryAll($sql, [$name => $value], $this->getEntityClass());
    }

    public function getCountWhere($name, $value)
    {
        $tableName = $this->getTableName();
        $sql = "SELECT count(id) as count FROM {$tableName} WHERE {$name} = :value";
        return App::call()->db->queryOne($sql, ['value' => $value])['count'];
    }

    public function insert(Model $entity): Model
    {
        $tableName = $this->getTableName();

        if ($tableName == 'users') {
            $user = App::call()->userRepository->getWhere('login', $entity->login);
            if ($user) {
                die('пользователь с таким логином уже существует');
            }
        }

        $params = [];
        $columns = [];
        foreach ($entity->props as $key => $value) {
            if ($entity->$key) {
                $params[":" . $key] = $entity->$key;
                $columns[] = $key;

                if($entity->props[$key]) {
                    $entity->props[$key] = false;
                }
            }
        }

        $columns = implode(', ', $columns);
        $values = implode(', ', array_keys($params));

        $sql = "INSERT INTO `{$tableName}`($columns) VALUES ($values)";
        App::call()->db->execute($sql, $params);
        $entity->id = App::call()->db->lastInsertId();
        return $entity;
    }

    public function update(Model $entity): Model
    {
        $params = [];
        $tableName = $this->getTableName();
        $sql = "UPDATE `{$tableName}` SET ";
        $ds = ', ';
        foreach ($entity->props as $key => $value) {
            if ($value) {
                $params[":" . $key] = $entity->$key;
                $sql .= "`$key` = :$key, ";

                $entity->props[$key] = false;
            }
        }
        if ($ds == substr($sql, -2)) {
            $sql = substr($sql, 0, -2);
        }

        $params[":id"] = (int)$entity->id;
        $sql .= " WHERE `id` = :id";
        App::call()->db->execute($sql, $params);
        return $entity;
    }

    public function save(Model $entity) {
        $entity->id ? $this->update($entity) : $this->insert($entity);
    }

    public function delete(Model $entity)
    {
        $tableName = $this->getTableName();
        $sql = "DELETE FROM $tableName WHERE id = :id";
        return App::call()->db->execute($sql, ['id' => $entity->id]);
    }

    public function getOne($id) {
        $tableName = $this->getTableName();
        $params = ['id' => (int)$id];
        $sql = "SELECT * FROM {$tableName} WHERE id = :id";
        return App::call()->db->queryOneObject($sql, $params, $this->getEntityClass());
    }

    public function getAll() {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName}";
        return App::call()->db->queryAll($sql);
    }

    public function getLimit($limit) {
        $tableName = $this->getTableName();
        $sql = "SELECT * FROM {$tableName} LIMIT 0, ?";
        return App::call()->db->queryLimit($sql, $limit);
    }
}
