<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 27/05/2019
 * Time: 14:16
 */

namespace App\Metier\Json;


class Piece
{

    public static $pieces_list = [
        "CC" => "CARTE CONSULAIRE",
        "PSP" => "PASSPORT",
        "CNI" => "CARTE NATIONNAL D'IDENTITE",
        "CR" => "CARTE DE RESIDENTS",
        "ATTN" => "ATTESTATION D'IDENTITE",


    ];
    public $type_p_piece;
    public $num_p_piece;
    public $date_exp_piece;
    public $nom_prenom;
    public $matricule;

    public static function getPieceLienString($name)
    {
        if (key_exists($name, self::$pieces_list)) {
            return self::$pieces_list[$name];
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
    public function __get($name)
    {
        return self::getPieceLienString($name);
    }
}
