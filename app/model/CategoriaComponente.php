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

    public function data($request){

        return $data = [
            'nome' => $request->nome,
            'tipo_valor' => $request->tipo_valor,
            'sigla_valor' => $request->sigla_valor
        ];
    }

    public function rules(){
        return [
        ];
    }

}