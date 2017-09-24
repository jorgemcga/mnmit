<?php

namespace App\Model;

use Core\ModeloEloquent;

class Licenca extends ModeloEloquent
{
    public $table = "licenca";

    public $fillable = [
        'nome',
        'serial',
        'datacompra',
        'datavence',
        'categoria_licenca_id'
    ];

    public function data($request){
        return [
            'nome' => $request->nome,
            'serial' => $request->serial,
            'datacompra' => $request->datacompra,
            'datavence' => $request->datavence,
            'categoria_licenca_id' => $request->categoria_licenca_id,
        ];
    }
    public function rules(){
        return [

        ];
    }

    public function categoria_licenca()
    {
        return $this->belongsTo("\App\Model\CategoriaLicenca");
    }
}