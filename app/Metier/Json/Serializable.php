<?php
/**
 * Created by PhpStorm.
 * User: BW.KOFFI
 * Date: 16/08/2017
 * Time: 17:43
 */

namespace App\Metier\Json;


abstract class  Serializable
{
    public function __toString()
    {
        return json_encode(get_object_vars($this));
    }
}