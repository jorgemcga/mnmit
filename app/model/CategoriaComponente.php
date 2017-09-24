<?php

namespace App\Model;

use Core\ModeloEloquent;

class CategoriaComponente extends ModeloEloquent
{
    protected $table = "categoria_componente";

    public $fillable = [
        'nome',
        'tipo_valor',
        'sigla_valor'
    ];
    public $timestamps = false;

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