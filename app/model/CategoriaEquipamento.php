<?php

namespace App\Model;


use Core\Model;

class CategoriaEquipamento extends Model
{
    protected $table = "categoria_equipamento";

    public $categoria_equipamento_id = "";
    public $nome = "";

    public function data($request){
        return [
            'nome' => $request->nome
        ];
    }

    public function rules(){
        return ['nome' => 'requerid|min:4'];
    }

}