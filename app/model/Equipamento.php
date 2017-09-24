<?php

namespace App\Model;

use Core\ModeloEloquent;

class Equipamento extends ModeloEloquent
{
    protected $table = "equipamento";

    public $timestamps = false;

    public $fillable = [
        'nrpatrimonio',
        'nome',
        'datacompra',
        'categoria_equipamento_id',
        'usuario_id'
    ];

    public function data($request){
        return [
            'nrpatrimonio' => $request->nrpatrimonio,
            'nome' => $request->nome,
            'datacompra' => $request->datacompra,
            'categoria_equipamento_id' => $request->categoria_equipamento_id,
            'usuario_id' => $request->usuario_id
        ];
    }

    public function rules(){
        return [

        ];
    }

    public function categoria_equipamento()
    {
        return $this->belongsTo("\App\Model\CategoriaEquipamento");
    }

    public function usuario(){
        return $this->belongsTo("\App\Model\Usuario");
    }

}