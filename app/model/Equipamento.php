<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 31/08/2017
 * Time: 09:44
 */

namespace App\Model;


use Core\Model;

class Equipamento extends Model
{
    protected $table = "equipamento";

    public $equipamento_id = "";
    public $nrpatrimonio = "";
    public $nome = "";
    public $categoria_equipamento_id = "";
    public $usuario_id = "";

}