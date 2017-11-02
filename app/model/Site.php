<?php

namespace App\Model;

use Core\ModeloEloquent;

class Site extends ModeloEloquent
{
    protected $table = "site";

    public $timestamps = false;

    public $fillable = [
        'url',
        'nome',
        'usuario',
        'senha'
    ];

    public function data($request){
        return [
            'url' => $request->url,
            'nome' => $request->nome,
            'usuario' => $request->usuario,
            'senha' => $request->senha
        ];
    }

    public function rules(){
        return [
        ];
    }

}