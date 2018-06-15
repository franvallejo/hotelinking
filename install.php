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
    echo "<div class='row mt-5 py-2'><div class='col-12 col-sm-12 col-md-4 offset-md-4 text-center'>Database created successfully.</div></div>";
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Init App</title>
    <link rel="stylesheet" href="/hotelinking/public/css/custom.css">
    <link rel="stylesheet" href="/hotelinking/public/assets/bootstrap/dist/css/bootstrap.css">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-12 col-sm-12 col-md-2 offset-md-5 text-center">
            <div class="form-group">
                <a href="http://localhost/hotelinking/" class="btn btn-primary">Inicio</a>
            </div>
        </div>
    </div>
</div>

</body>
</html>
