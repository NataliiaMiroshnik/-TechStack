<?php

interface SQLQueryBuilder {
    public function select($columns);
    public function where($condition);
    public function limit($limit);
    public function getSQL();
}

class PostgreSQLQueryBuilder implements SQLQueryBuilder {
    private $query;

    public function select($columns) {
        $this->query = "SELECT " . implode(', ', $columns);
        return $this;
    }

    public function where($condition) {
        $this->query .= " WHERE " . $condition;
        return $this;
    }

    public function limit($limit) {
        $this->query .= " LIMIT " . $limit;
        return $this;
    }

    public function getSQL() {
        return $this->query;
    }
}

class MySQLQueryBuilder implements SQLQueryBuilder {
    private $query;

    public function select($columns) {
        $this->query = "SELECT " . implode(', ', $columns);
        return $this;
    }

    public function where($condition) {
        $this->query .= " WHERE " . $condition;
        return $this;
    }

    public function limit($limit) {
        $this->query .= " LIMIT " . $limit;
        return $this;
    }

    public function getSQL() {
        return $this->query;
    }
}

$postgreSQLBuilder = new PostgreSQLQueryBuilder();
$query = $postgreSQLBuilder
    ->select(['name', 'email'])
    ->where('age > 25')
    ->limit(10)
    ->getSQL();

echo "PostgreSQL Query: $query\n";

$mySQLBuilder = new MySQLQueryBuilder();
$query = $mySQLBuilder
    ->select(['name', 'email'])
    ->where('age > 25')
    ->limit(10)
    ->getSQL();

echo "MySQL Query: $query\n";

?>