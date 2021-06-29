<?php

namespace app\engine;

use app\traits\TQuery;
use PDO;

class Query
{
    use TQuery;

    const QUERY_INSERT_TYPE = 1;
    const QUERY_UPDATE_TYPE = 2;
    const QUERY_DELETE_TYPE = 3;

    protected $modelClass;
    protected $queryString = null;

    protected static $connect = null;

    public function __construct($modelClass)
    {
        $this->setModelClass($modelClass);
    }

    public function executeSqlQuery($sql, $type = self::QUERY_INSERT_TYPE)
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

    public function insert($data)
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

    public function update($id, $data)
    {
        $sql = $this->getSqlChangeQuery($data);
        if (empty($sql)) {
            die('Нет элементов для изменения');
        }
        $this->setQueryString($sql);
        $this->where = [ 'id' => $id ];
        $this->getQueryBuilder();
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

        if ($this->limit) {
            $string .= " LIMIT 0, " . $this->limit;
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
        $query->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, $this->getModelClass());
        $query->execute();
        return $query;
    }

    private function getSqlAppendQuery($data)
    {
        return "INSERT INTO" . " " . $this->getTableName()
                . "(`" . implode('`,`', array_keys($data)) . "`)"
                . " VALUES " . "('" . implode('\',\'', $data) . "')";
    }

    private function getSqlChangeQuery($data)
    {
        $sql = "";
        static $counter = 1;
        if ($data) {
            $sql .= "UPDATE " . $this->getTableName() . " SET ";
            foreach ($data as $attribute => $value) {
                $sql .= "`{$attribute}` = '". $value . "'";
                if (count($data) != $counter) {
                    $sql .= ", ";
                }
                $counter++;
            }
        }
        return $sql;
    }

    private function getDbConnect()
    {
        if (is_null(static::$connect)) {
            static::$connect = (new Db())->getConnection();
        }
        return static::$connect;
    }
}