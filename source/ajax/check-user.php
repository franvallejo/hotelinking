<?php
/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 11/06/2018
 * Time: 15:43
 */

require_once '../../config.php';
require_once '../class/Querys.php';
require_once '../class/Users.php';

try {
    $currentUser = $_POST['userName'];
    $currentPass = $_POST['password'];
    $type = $_POST['type'];

    $user = new Users($username, $password, $dbname, $dsn, $options);

    // Check si el usuario que accede a la aplicación ya esta dado de alta en la BBDD
    $params = [
        'params' => 'all',
        'tables' => 'users',
        'where' => [
            'name' => $currentUser
        ],
        'and' => [
            'pass' => $currentPass
        ]
    ];

    $result = $user->getUsers($params);
    $rows = $result->rowCount();
    $result = null; // Se cierra conexión con BBDD

    // Check si se puede realizar el registro en funcion de si el usuario existe
    if ($type == 'registro' && $rows == 0) {
        $params = [
            'tables' => 'users',
            'params' => [
                'name' => $currentUser,
                'pass' => $currentPass
            ]
        ];
        $result = $user->newUser($params);
        $result = null; // Se cierra conexión con BBDD
        echo json_encode('newUser');
    } else if ($type == 'registro' && $rows >= 1) {
        echo json_encode('member');
    }

    // Check si se puede logear en función de si el usuario existe
    if ($type == 'login' && $rows == 0) {
        echo json_encode('newUser');
    } else if ($type == 'login' && $rows >= 1) {
        $params = [
            'params' => 'id',
            'tables' => 'users',
            'where' => [
                'name' => $currentUser
            ]
        ];
        $result = $user->getUsers($params);
        unset($_SESSION['id_user']);
        $_SESSION['id_user'] = $result->fetchAll();
        $result = null; // Se cierra conexión con BBDD
        echo json_encode('member');
    }

} catch (Exception $Ex) {
    var_dump($Ex);
}