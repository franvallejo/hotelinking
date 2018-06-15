<?php

/**
 * Created by PhpStorm.
 * User: fran
 * Date: 13/06/2018
 * Time: 16:23
 */
class Promos extends Querys
{
    function newPromo($params)
    {
        return $this->insert($params);
    }

    function getPromo($params)
    {
        return $this->select($params);
    }

    function updatePromo($params)
    {
        return $this->update($params);
    }
}