<?php

namespace App\Model;


use Core\Model;

class ModeloModel extends Model
{
    protected $table = "modelo";

    public $nome = "";
    public $fabricante_id = "";

    public function data($request){
        return [
            'nome' => $request->nome,
            'fabricante_id' => $request->fabricante_id
        ];
    }

}