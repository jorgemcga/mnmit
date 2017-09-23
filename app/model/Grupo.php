<?php
/**
 * Created by PhpStorm.
 * User: Jorge
 * Date: 17/09/2017
 * Time: 16:12
 */

namespace App\Model;


use Core\ModeloEloquent;

class Grupo extends ModeloEloquent
{
    public $table = "grupo";

    public $fillable = ['nome'];

    public function data($request){
        return [
          'nome' => $request->nome
        ];
    }

}