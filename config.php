<?php
/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 08/06/2018
 * Time: 11:14
 */

session_start();

$host = "localhost";
$username = "root";
$password = "";
$dbname = "alfa";
$dsn = "mysql:host=$host;dbname=$dbname";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);