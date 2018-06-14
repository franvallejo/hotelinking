<?php
/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 08/06/2018
 * Time: 11:14
 */

require "config.php";

try {
    $connection = new PDO("mysql:host=$host", $username, $password, $options);
    $sql = file_get_contents("data/alfa.sql");
    $connection->exec($sql);
    echo "Database created successfully.";
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}