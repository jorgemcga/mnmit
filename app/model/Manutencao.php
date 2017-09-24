<?php

namespace App\Model;

use Core\ModeloEloquent;
use PDO;

class Manutencao extends ModeloEloquent
{

    protected $table = "manutencao";

    public $fillable = [
        'descricao',
        'datainicio',
        'datafim',
        'status',
        'ativo_id'
    ];

    public function data($request){
        return [
            'descricao' => $request->descricao,
            'datainicio' => $request->datainicio,
            'datafim' => $request->datafim,
            'status' => $request->status,
            'ativo_id' => $request->ativo_id
        ];
    }

    public function rules(){
        return [

        ];
    }

    public function ativo()
    {
        return $this->belongsTo("\App\Model\Ativo");
    }
}