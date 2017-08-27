<?php

namespace App\Model;

use Core\Model;

class Ativo extends Model
{
    protected $table = "ativo";

    public $ativo_id = "";
    public $nrpatrimonio = "";
    public $nome = "";
    public $tag = "";
    public $descricao = "";
    public $datacompra = "";
    public $monitorar = "checked";
    public $categoria_ativo_id = "";
    public $so_id = "";
    public $serial = "";
    public $modelo_id = "";
    public $usuario_id = "";

}