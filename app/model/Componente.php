<?php

namespace App\Model;

use Core\ModeloEloquent;

class Componente extends ModeloEloquent
{
    protected $table = "componente";

    public $fillable = [
        'nome',
        'valor',
        'categoria_componente_id',
        '$ativo_id'
    ];


    public function data($request){
        return [
            'nome' => $request->nome,
            'valor' => $request->valor,
            'categoria_componente_id' => $request->categoria_componente_id,
            'ativo_id' => $request->ativo_id
        ];
    }

    public function rules(){
        return [

        ];
    }

    public function categoria_componente()
    {
        return $this->belongsTo("\App\Model\CategoriaComponente");
    }

    public function ativo()
    {
        return $this->belongsTo("\App\Model\Ativo");
    }
}