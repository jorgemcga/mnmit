<?php

namespace App\Model;

use Core\Model;
use PDO;

class Manutencao extends Model
{

    protected $table = "manutencao";

    public $manutencao_id = "";
    public $descricao = "";
    public $datainicio = "";
    public $datafim = "";
    public $status = "";
    public $ativo_id = "";

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);
        $this->datafim = date('Y-m-d\TH:i:s');
        $this->datainicio = date('Y-m-d\TH:i:s');
    }
}