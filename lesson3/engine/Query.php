<?php

namespace app\engine;

use app\traits\TQuery;
use PDO;

class Query
{
    use TQuery;

    const QUERY_INSERT_TYPE = 1;
    const QUERY_UPDATE_TYPE = 2;

    protected $modelClass;
    protected $queryString = null;

    protected static $connect = null;

    public function __construct($modelClass)
    {
        $this->setModelClass($modelClass);
    }

    public function executeSqlQuery(string $sql, $type = self::QUERY_INSERT_TYPE)
    {
        $conn = $this->getDbConnect();
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return ($type == self::QUERY_INSERT_TYPE) ? $conn->lastInsertId() : $stmt->rowCount();
    }

    public function getModelClass()
    {
        return $this->modelClass;
    }

    public function setModelClass($modelClass)
    {
        $this->modelClass = $modelClass;
    }

    public function getTableName()
    {
        $modelClass = $this->getModelClass();
        return (new $modelClass())->getTableName();
    }

    public function getQueryString()
    {
        if (is_null($this->queryString)) {
            $this->setQueryString("SELECT * FROM" . " " . $this->getTableName());
        }
        return $this->queryString;
    }

    public function setQueryString($queryString)
    {
        $this->queryString = $queryString;
    }

    public function all()
    {
        return $this->getQueryBuilder()->fetchAll();
    }

    public function one()
    {
        return $this->getQueryBuilder()->fetch();
    }

    public function save($data)
    {
        $sql = $this->getSqlAppendQuery($data);
        return $this->executeSqlQuery($sql);
    }

    public function delete($id)
    {
        $this->setQueryString("DELETE FROM" . " " . $this->getTableName());
        $this->where = [ 'id' => $id ];
        $this->getQueryBuilder();
    }

    public function update($data)
    {
//        update
    }

    public function getQuery(string $queryString, array $params = [])
    {
        $query = $this->getDbConnect()->prepare($queryString);
        if (!empty($params)) {
            foreach ($params as $key => $item) {
               $query->bindValue(":{$key}", $item);
            }
        }
        return $query;
    }

    protected function populate(&$queryString)
    {
        $string = "";
        if ($this->sort) {
            $string .= " ORDER BY " . $this->sort;
        }

        if ($conditions = $this->where) {
            $string .= " WHERE ";
            foreach ($conditions as $attr => $value) {
                $string .= $attr . " = :" . $attr;
            }
        }

        if ($string != "") {
            $queryString .= $string;
        }
    }

    protected function getQueryBuilder()
    {
        $queryString = $this->getQueryString();
        $this->populate($queryString);
        $query = $this->getQuery($queryString, $this->where);
        $query->setFetchMode(PDO::FETCH_CLASS, $this->getModelClass());
        $query->execute();
        return $query;
    }

    private function getSqlAppendQuery($data)
    {
        return "INSERT INTO" . " " . $this->getTableName()
                . "(`" . implode('`,`', array_keys($data)) . "`)"
                . " VALUES " . "('" . implode('\',\'', $data) . "')";
    }

    private function getDbConnect()
    {
        if (is_null(static::$connect)) {
            static::$connect = (new Db())->getConnection();
        }
        return static::$connect;
    }
}