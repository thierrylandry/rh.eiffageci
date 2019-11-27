<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 27/11/2019
 * Time: 12:42
 */

namespace App\Metier\Json;


class Rubrique
{

    public $libelle;
    public $operation;
    public $valeur;


    public function __get($name)
    {
        return self::getFamilleLienString($name);
    }

}