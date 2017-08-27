<?php

namespace App\Model;

use Core\Model;

class SistemaOperacional extends Model
{
    protected $table = "so";

    public $so_id;
    public $nome;
    public $versao;

}