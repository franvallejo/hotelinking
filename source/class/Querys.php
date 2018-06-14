<?php

/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 08/06/2018
 * Time: 12:18
 */
class Querys
{
    function __construct($username, $password, $dbname, $dsn, $options)
    {
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->dsn = $dsn;
        $this->options = $options;

        $this->connection = new PDO($this->dsn, $this->username, $this->password, $this->options);
        $this->connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
    }

    function select($params)
    {
        // params['params'];
        // params['tables'];
        // params['where'];
        // params['and'];

        if ($params['params'] == 'all') {
            $sql = 'SELECT * FROM ';
        } else {
            if (is_array($params['params'])) {
                $lastIndex = end($params['params']);
                $sql = 'SELECT ';
                foreach ($params['params'] as $param) {
                    if ($lastIndex == $param) {
                        $sql .= $param . ' FROM ';
                    } else {
                        $sql .= $param . ', ';
                    }
                }
            } else {
                $sql = 'SELECT ' . $params['params'] . ' FROM ';
            }
        }

        if (is_array($params['tables'])) {
            $lastIndex = end($params['tables']);
            foreach ($params['tables'] as $table) {
                if ($lastIndex == $table) {
                    $sql .= $table;
                } else {
                    $sql .= $table . ', ';
                }
            }
        } else {
            $sql .= $params['tables'];
        }

        if (is_array($params['where'])) {
            foreach ($params['where'] as $column => $value) {
                if (is_integer($value)) {
                    $sql .= ' WHERE ' . $column . ' = ' . $value . '';
                } else if (is_string($value)) {
                    $sql .= ' WHERE ' . $column . ' = "' . $value . '"';
                }
            }
        }

        if (isset($params['and']) && $params['and'] !== '') {
            if (count($params['and']) > 1) {
                foreach ($params['and'] as $column => $value) {
                    $sql .= ' AND ' . $column . ' = "' . $value . '" ';
                }
            } else if (count($params['and'] == 1)) {
                foreach ($params['and'] as $column => $value) {
                    $sql .= ' AND ' . $column . ' = "' . $value . '"';
                }
            }
        }

        $statement = $this->connection->prepare($sql);
        $statement->execute();
        return $statement;

        //$statement = null;
    }

    function insert($params)
    {
        // params['tables'];
        // params['params'];

        if ($params['tables'] == 'users') {
            $sql = 'INSERT INTO users(name, pass) VALUES(:name, :pass)';
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':name', $params['params']['name']);
            $statement->bindParam(':pass', $params['params']['pass']);
        } else if ($params['tables'] == 'promos') {
            $sql = 'INSERT INTO promos(promo, checked, id_user) VALUES(:promo, :checked, :id_user)';
            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':promo', $params['params']['promo']);
            $statement->bindParam(':checked', $params['params']['checked']);
            $statement->bindParam(':id_user', $params['params']['id_user']);
        }

        $statement->execute();
    }

    function update($params)
    {
        // params['tables'];
        // params['params'];
        // params['where'];
        // params['condition'];

        foreach ($params['condition'] as $key => $value) {
            $sql = 'UPDATE ' . $params['tables'] . ' SET ';
            if (count($params['params']) > 1) {
                foreach ($params['params'] as $column => $param) {
                    $sql .= $column . ' = ' . $param . ', ';
                }
            } else if (count($params['params']) == 1) {
                foreach ($params['params'] as $column => $param) {
                    $sql .= $column . ' = ' . $param . ' WHERE ';
                }
            }
            $sql .= $params['where'] . ' = :condition';

            $statement = $this->connection->prepare($sql);
            $statement->bindParam(':condition', $value);
            $statement->execute();
            echo 1;
        }
    }

    function delete($params)
    {

    }
}