<?php

/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 06/05/2019
 * Time: 11:32
 */
namespace App\Metier\Json;

class Element extends Serializable
{

    public $valeur;


    public function __get($name)
    {
        return self::getFamilleLienString($name);
    }
}