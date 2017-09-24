<?php

namespace App\Model;

use Core\ModeloEloquent;

class CategoriaEquipamento extends ModeloEloquent
{
    protected $table = "categoria_equipamento";

    public $fillable = ["nome"];
    public $timestamps = false;

    public function data($request){
        return [
            'nome' => $request->nome
        ];
    }

    public function rules(){
        return ['nome' => 'requerid|min:4'];
    }

}