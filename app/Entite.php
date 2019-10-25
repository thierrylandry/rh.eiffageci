<?php
/**
 * Created by PhpStorm.
 * User: ckodia
 * Date: 16/10/2019
 * Time: 10:52
 */

namespace App;

use Illuminate\Database\Eloquent\Model;
class Entite extends Model
{
    protected  $table="entite";
    protected $fillable= ['*'];

}