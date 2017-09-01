<?php

namespace App\Model;

use Core\Model;

class Manutencao extends Model
{

    protected $table = "manutencao";

    public $manutencao_id = "";
    public $descricao = "";
    public $datainicio = "";
    public $datafim = "";
    public $status = "";
    public $ativo_id = "";
}