<?php
/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 11/06/2018
 * Time: 15:43
 */

require_once '../../config.php';
require_once '../class/Querys.php';
require_once '../class/Promos.php';

try {
    $type = $_POST['type'];
    $id_user = $_SESSION['id_user'][0]['id'];

    $promo = new Promos($username, $password, $dbname, $dsn, $options);

    if ($type == 'registro') {
        $promo_name = $_POST['promo'];
        $checked = $_POST['checked'];

        $params = [
            'tables' => 'promos',
            'params' => [
                'promo' => $promo_name,
                'checked' => $checked,
                'id_user' => $id_user
            ]
        ];

        $result = $promo->newPromo($params);
        $result = null; // Se cierra conexión con BBDD
        exit;
    } else if ($type == 'listado') {
        $params = [
            'params' => 'all',
            'tables' => 'promos',
            'where' => [
                'id_user' => intval($id_user)
            ]
        ];

        $result = $promo->getPromo($params);
        $result = $result->fetchAll();
        echo json_encode($result);
        $result = null; // Se cierra conexión con BBDD
        exit;
    } else if ($type == 'canjear') {
        $promo_name = $_POST['promo'];
        $checked = $_POST['checked'];

        $params = [
            'tables' => 'promos',
            'params' => [
                'checked' => $checked
            ],
            'where' => 'promo',
            'condition' => $promo_name
        ];

        $result = $promo->updatePromo($params);
        $result = null; // Se cierra conexión con BBDD
        exit;
    }

} catch (Exception $Ex) {
    var_dump($Ex);
}