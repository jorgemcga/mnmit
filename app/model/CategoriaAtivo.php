<?php

namespace App\Model;

use Core\ModeloEloquent;

class CategoriaAtivo extends ModeloEloquent
{
    protected $table = "categoria_ativo";

    public $timestamps = false;

    public $fillable = ['nome'];

    public function data($request){
        return [
            'nome' => $request->nome
        ];
    }

}