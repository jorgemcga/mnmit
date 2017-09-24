<?php

namespace App\Model;

use Core\ModeloEloquent;

class CategoriaLicenca extends ModeloEloquent
{
    public $table = "categoria_licenca";

    public $fillable = ['nome', 'sigla'];
    public $timestamps = false;

    public function data($request){
        return [
            'nome' => $request->nome,
            'sigla' => $request->sigla
        ];
    }

    public function rules(){
        return [

        ];
    }

}