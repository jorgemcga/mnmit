<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 09/09/2017
 * Time: 12:47
 */

namespace App\Model;


use Core\Model;
use PDO;

class Licenca extends Model
{
    public $table = "licenca";

    public $licenca_id = "";
    public $nome = "";
    public $serial = "";
    public $datacompra = "";
    public $datavence = "";
    public $categoria_licenca_id = "";

    public function __construct(PDO $pdo)
    {
        parent::__construct($pdo);

        $this->datacompra = date('Y-m-d');
        $this->datavence = date('Y-m-d');
    }

}