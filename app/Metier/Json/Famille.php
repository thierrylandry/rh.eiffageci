<?php

/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 06/05/2019
 * Time: 11:32
 */
namespace App\Metier\Json;

class Famille extends Serializable
{
    public static $lien_parente_list = [
        "CONJ" => "Conjoint",
        "ENF" => "Enfant",

    ];
    public static $pieces_list = [
        "CC" => "CARTE CONSULAIRE",
        "PSP" => "PASSPORT",
        "CNI" => "CARTE NATIONNAL D'IDENTITE",


    ];    public static $presence_effective_list = [
        "P" => "PRESENT",
        "ABS" => "ABSENT",


    ];

    public $nom_prenom;
    public $lien_parente;
    public $type_p;
    public $num_p;
    public $date_exp;
    public $presence_effective;

    public static function getFamilleLienString($name)
    {
        if (key_exists($name, self::$lien_parente_list)) {
            return self::$lien_parente_list[$name];
        } else {
            return null;
        }
    }
    public static function getPieceString($name)
    {
        if (key_exists($name, self::$pieces_list)) {
            return self::$pieces_list[$name];
        } else {
            return null;
        }
    }
    public static function getListePresence($name)
    {
        if (key_exists($name, self::$presence_effective_list)) {
            return self::$presence_effective_list[$name];
        } else {
            return null;
        }
    }
    public function __get($name)
    {
        return self::getFamilleLienString($name);
    }
}