<?php

namespace App\Model;

use Core\Model;

class CategoriaComponente extends Model
{
    protected $table = "categoria_componente";

    public $categoria_componente_id = "";
    public $nome = "";
    public $tipo_valor = "";
    public $sigla_valor = "";

}