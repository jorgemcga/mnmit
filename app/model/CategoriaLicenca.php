<?php

namespace App\Model;


use Core\Model;

class CategoriaLicenca extends Model
{
    public $table = "categoria_licenca";

    public $categoria_licenca_id = "";
    public $nome = "";
    public $sigla = "";

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