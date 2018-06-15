<?php

/**
 * Created by PhpStorm.
 * User: Fran Informatica
 * Date: 08/06/2018
 * Time: 11:24
 */
class Users extends Querys
{
    function getUsers($params)
    {
        return $this->select($params);
    }

    function newUser($params)
    {
        return $this->insert($params);
    }
}