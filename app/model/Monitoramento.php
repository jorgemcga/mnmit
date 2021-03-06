<?php

namespace App\Model;

use Core\ModeloEloquent;

class Monitoramento extends ModeloEloquent
{

    protected $table = "monitor";

    public $fillable = [
        'status',
        'nome',
        'email',
        'plataforma'
    ];

    public function data($request){
        return [
            'nome' => $request->nome,
            'email' => $request->email,
            'plataforma' => $request->plataforma
        ];
    }

    public function rules(){
        return [

        ];
    }

}