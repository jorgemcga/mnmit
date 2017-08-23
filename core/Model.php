<?php

namespace Core;

use PDO;

abstract class Model
{
    private $pdo;
    protected $table;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;

    }

    public function all(){

        $query = "SELECT * FROM {$this->table}";

        $stmt = $this->pdo->prepare($query);
        $stmt->execute();

        $result = $stmt->fetchAll();

        $stmt->closeCursor();

        return $result;
    }

    public function find($id){

        $query = "SELECT * FROM {$this->table} WHERE {$this->table}_id = :id";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindValue(":id", $id);
        $stmt->execute();

        $result = $stmt->fetch();

        $stmt->closeCursor();

        return $result;
    }

    public function insert(array $data){

        $data = $this->prepareDataInsert($data);

        $query = "INSERT INTO {$this->table} ({$data['strKeys']}) VALUES ({$data['strBinds']})";

        $stmt = $this->pdo->prepare($query);

        for ($i=0; $i < count($data['bind']); $i++){

            $stmt->bindValue("{$data['bind'][$i]}", $data['values'][$i]);

        }

        $result = $stmt->execute();

        if (!$result) return false;

        return $id = $this->pdo->lastInsertId();
    }

    private function prepareDataInsert(array $data){

        $strKeys = "";
        $strBinds = "";
        $binds = [];
        $values = [];

        foreach ($data as $key => $value){
            $strKeys = "{$strKeys},{$key}";
            $strBinds = "{$strBinds},:{$key}";
            $binds[] = ":{$key}";
            $values[] = $value;
        }

        $strKeys = substr($strKeys, 1);
        $strBinds = substr($strBinds, 1);

        return [
            'strKeys' => $strKeys,
            'strBinds' => $strBinds,
            'binds' => $binds,
            'values' => $values,
        ];
    }


}